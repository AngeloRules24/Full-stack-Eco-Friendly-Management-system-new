<?php
ob_start();
$base_path = '/rwdd/RWDD group assignment/'; 
include "../../header.php";
include "../../conn.php";

$success_message = '';
$error_message = '';

if (isset($_GET['success'])) {
    $success_message = urldecode($_GET['success']);
}

if (!isset($_SESSION['user_id'])) {
    header("Location:" . $base_path . "signinsignup/login.php");
    ob_end_flush();
    exit();
}

$produce_id = isset($_GET['produce_id']) ? intval($_GET['produce_id']) : 0;

$produce = null;
if ($produce_id > 0) {
    $sql = "SELECT pe.*, u.user_name as posted_by, u.user_id as owner_id
            FROM produceexchange pe 
            JOIN user u ON pe.user_id = u.user_id 
            WHERE pe.produce_id = ?";
    $stmt = mysqli_prepare($dbConn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $produce_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $produce = mysqli_fetch_assoc($result);
    }
}

if (!$produce) {
    header("Location: produceexchange.php");
    exit();
}

$is_owner = ($produce['owner_id'] == $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offer_produce'])) {
    $offer_produce = mysqli_real_escape_string($dbConn, $_POST['offer_produce']);
    $offer_producedescription = mysqli_real_escape_string($dbConn, $_POST['offer_producedescription']);
    $from_user_id = $_SESSION['user_id'];
    $to_user_id = $produce['owner_id'];
    
    $insert_sql = "INSERT INTO exchange_details (produce_id, from_user_id, to_user_id, offer_produce, offer_producedescription) 
                   VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($dbConn, $insert_sql);
    mysqli_stmt_bind_param($stmt, "iiiss", $produce_id, $from_user_id, $to_user_id, $offer_produce, $offer_producedescription);
    
    if (mysqli_stmt_execute($stmt)) {
        $success_message = 'Trade offer sent successfully!';
        header("Location: exchangedetails.php?produce_id=" . $produce_id . "&success=" . urlencode($success_message));
        exit();
    } else {
        $error_message = 'Error sending trade offer. Please try again.';
    }
}

$trade_offers = [];
if ($is_owner) {
    $offers_sql = "SELECT ed.offer_id, ed.offer_produce, ed.offer_producedescription, ed.offer_status, u.user_name as from_user_name 
                   FROM exchange_details ed 
                   JOIN user u ON ed.from_user_id = u.user_id 
                   WHERE ed.produce_id = ? AND ed.offer_status = 'pending'";
    $offers_stmt = mysqli_prepare($dbConn, $offers_sql);
    mysqli_stmt_bind_param($offers_stmt, "i", $produce_id);
    mysqli_stmt_execute($offers_stmt);
    $offers_result = mysqli_stmt_get_result($offers_stmt);
    
    if ($offers_result && mysqli_num_rows($offers_result) > 0) {
        while ($offer = mysqli_fetch_assoc($offers_result)) {
            $trade_offers[] = $offer;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offer_action'])) {
    $offer_id = intval($_POST['offer_id']);
    $action = $_POST['offer_action'];
    
    if (in_array($action, ['accepted', 'rejected'])) {
        if ($action === 'accepted') {
            mysqli_begin_transaction($dbConn);
            
            try {
                $update_sql = "UPDATE exchange_details SET offer_status = 'accepted' WHERE offer_id = ? AND produce_id = ?";
                $update_stmt = mysqli_prepare($dbConn, $update_sql);
                mysqli_stmt_bind_param($update_stmt, "ii", $offer_id, $produce_id);
                
                if (!mysqli_stmt_execute($update_stmt)) {
                    throw new Exception('Error accepting the offer');
                }
                
                $reject_sql = "UPDATE exchange_details SET offer_status = 'rejected' WHERE produce_id = ? AND offer_id != ? AND offer_status = 'pending'";
                $reject_stmt = mysqli_prepare($dbConn, $reject_sql);
                mysqli_stmt_bind_param($reject_stmt, "ii", $produce_id, $offer_id);
                
                if (!mysqli_stmt_execute($reject_stmt)) {
                    throw new Exception('Error rejecting other offers');
                }
                
                $update_produce_sql = "UPDATE produceexchange SET status = 'traded' WHERE produce_id = ?";
                $update_produce_stmt = mysqli_prepare($dbConn, $update_produce_sql);
                mysqli_stmt_bind_param($update_produce_stmt, "i", $produce_id);
                
                if (!mysqli_stmt_execute($update_produce_stmt)) {
                    throw new Exception('Error updating produce status');
                }
                
                mysqli_commit($dbConn);
                $success_message = 'Trade offer accepted! All other offers have been automatically rejected and the produce has been marked as traded.';
                
            } catch (Exception $e) {
                mysqli_rollback($dbConn);
                $error_message = 'Error processing trade offer. Please try again.';
            }
        } else {
            $update_sql = "UPDATE exchange_details SET offer_status = 'rejected' WHERE offer_id = ? AND produce_id = ?";
            $update_stmt = mysqli_prepare($dbConn, $update_sql);
            mysqli_stmt_bind_param($update_stmt, "ii", $offer_id, $produce_id);
            
            if (mysqli_stmt_execute($update_stmt)) {
                $success_message = 'Trade offer rejected.';
            } else {
                $error_message = 'Error rejecting trade offer. Please try again.';
            }
        }
        
        header("Location: exchangedetails.php?produce_id=" . $produce_id . "&success=" . urlencode($success_message));
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($produce['produce_name']); ?> - Trade Details</title>
    <link rel="stylesheet" href="exchangedetails.css">
</head>
<body>

<div class="container">
    <div class="back-button">
        <a href="exchangehomegrownproduce.php">&larr; Back to Produce Exchange</a>
    </div>
    
    <?php if (!empty($success_message)): ?>
        <div class="success-message">
            ✅ <?php echo htmlspecialchars($success_message); ?>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($error_message)): ?>
        <div class="error-message">
            ❌ <?php echo htmlspecialchars($error_message); ?>
        </div>
    <?php endif; ?>

    <!-- Produce Details -->
    <div class="produce-details">
        <h1><?php echo htmlspecialchars($produce['produce_name']); ?></h1>
        <div class="produce-meta">
            <div class="meta-item posted-by">Posted by: <?php echo htmlspecialchars($produce['posted_by']); ?></div>
            <div class="meta-item status <?php echo $produce['status']; ?>">
                Status: <?php echo ucfirst($produce['status']); ?>
            </div>
        </div>
        <div class="produce-description">
            <?php echo nl2br(htmlspecialchars($produce['produce_description'])); ?>
        </div>
    </div>

    <!-- Show traded message if produce is traded -->
    <?php if ($produce['status'] === 'traded'): ?>
        <div class="traded-message">
            🎉 This produce has been successfully traded!
        </div>
    <?php endif; ?>

    <!-- Trade Offer Form (only show if user is NOT the owner and produce is available) -->
    <?php if (!$is_owner && $produce['status'] === 'available'): ?>
        <div class="trade-form">
            <h2>Make a Trade Offer</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="offer_produce">What are you offering?</label>
                    <input type="text" id="offer_produce" name="offer_produce" placeholder="e.g., Fresh Apples, Homemade Bread, etc." required>
                </div>
                <div class="form-group">
                    <label for="offer_producedescription">Describe your offer:</label>
                    <textarea id="offer_producedescription" name="offer_producedescription" placeholder="Describe what you're offering in exchange..." required></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Trade Offer</button>
            </form>
        </div>
    <?php endif; ?>

    <!-- Trade Offers Section (only show if user IS the owner and produce is available) -->
    <?php if ($is_owner && $produce['status'] === 'available'): ?>
        <div class="trade-offers">
            <h2>Trade Offers</h2>
            <?php if (empty($trade_offers)): ?>
                <div class="no-offers">
                    <p>No trade offers yet. Check back later!</p>
                </div>
            <?php else: ?>
                <div class="owner-note" style="margin-bottom: 20px;">
                    <strong>Note:</strong> When you accept one offer, all other pending offers will be automatically rejected.
                </div>
                <?php foreach ($trade_offers as $offer): ?>
                    <div class="offer-item">
                        <div class="offer-from">Offer from: <?php echo htmlspecialchars($offer['from_user_name']); ?></div>
                        <div class="offer-produce">Offering: <?php echo htmlspecialchars($offer['offer_produce']); ?></div>
                        <div class="offer-description"><?php echo nl2br(htmlspecialchars($offer['offer_producedescription'])); ?></div>
                        <div class="offer-actions">
                            <form method="POST" action="" style="display: inline;">
                                <input type="hidden" name="offer_id" value="<?php echo $offer['offer_id']; ?>">
                                <input type="hidden" name="offer_action" value="accepted">
                                <button type="submit" class="accept-btn">Accept Offer</button>
                            </form>
                            <form method="POST" action="" style="display: inline;">
                                <input type="hidden" name="offer_id" value="<?php echo $offer['offer_id']; ?>">
                                <input type="hidden" name="offer_action" value="rejected">
                                <button type="submit" class="reject-btn">Reject Offer</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Show appropriate message for different states -->
    <?php if ($is_owner && $produce['status'] === 'traded'): ?>
        <div class="owner-note">
            This produce has been successfully traded. Thank you for using our platform!
        </div>
    <?php elseif (!$is_owner && $produce['status'] === 'traded'): ?>
        <div class="owner-note">
            This produce has already been traded. Check out other available produce!
        </div>
    <?php elseif ($is_owner && $produce['status'] === 'available' && empty($trade_offers)): ?>
        <div class="owner-note">
            You are the owner of this listing. Trade offers will appear here when other users make offers.
        </div>
    <?php elseif (!$is_owner && $produce['status'] === 'available'): ?>
        <div class="owner-note">
            You are viewing this produce listing. To make a trade offer, use the form above.
        </div>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = document.querySelector('.success-message');
        const errorMessage = document.querySelector('.error-message');
        
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                setTimeout(() => {
                    successMessage.remove();
                }, 300);
            }, 5000);
        }
        
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.style.opacity = '0';
                setTimeout(() => {
                    errorMessage.remove();
                }, 300);
            }, 5000);
        }
    });
</script>

<?php include "../../footer.php"; ?>
</body>
</html>