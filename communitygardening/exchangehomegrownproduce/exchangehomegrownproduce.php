<?php
ob_start();
$base_path = '/rwdd/RWDD group assignment/'; 
include "../../header.php";
include "../../conn.php";

if (!isset($_SESSION['user_id'])) {
    header("Location:" . $base_path . "signinsignup/login.php");
    ob_end_flush();
    exit();
}

$current_filter = isset($_GET['filter']) ? $_GET['filter'] : 'listed';

$availableProducts = [];
$sql = "SELECT pe.produce_id, pe.produce_name, pe.produce_description, u.user_name as posted_by, pe.status, pe.created_at 
        FROM produceexchange pe 
        JOIN user u ON pe.user_id = u.user_id 
        WHERE pe.status = 'available' 
        ORDER BY pe.created_at DESC";
$result = mysqli_query($dbConn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $availableProducts[] = $row;
    }
}

$myListedProducts = [];
if ($current_filter === 'my_listed') {
    $my_listed_sql = "SELECT pe.produce_id, pe.produce_name, pe.produce_description, pe.status, pe.created_at,
                             COUNT(ed.offer_id) as offer_count
                      FROM produceexchange pe 
                      LEFT JOIN exchange_details ed ON pe.produce_id = ed.produce_id AND ed.offer_status = 'pending'
                      WHERE pe.user_id = ?
                      GROUP BY pe.produce_id
                      ORDER BY pe.created_at DESC";
    $stmt = mysqli_prepare($dbConn, $my_listed_sql);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $my_listed_result = mysqli_stmt_get_result($stmt);
    
    if ($my_listed_result && mysqli_num_rows($my_listed_result) > 0) {
        while ($row = mysqli_fetch_assoc($my_listed_result)) {
            $myListedProducts[] = $row;
        }
    }
}

$userRequests = [];
if (in_array($current_filter, ['pending', 'accepted', 'rejected'])) {
    $requests_sql = "SELECT ed.*, pe.produce_name, pe.produce_description, u.user_name as owner_name, 
                            pe.status as produce_status
                     FROM exchange_details ed 
                     JOIN produceexchange pe ON ed.produce_id = pe.produce_id 
                     JOIN user u ON pe.user_id = u.user_id 
                     WHERE ed.from_user_id = ? 
                     AND ed.offer_status = ?
                     ORDER BY ed.offer_id DESC";
    $stmt = mysqli_prepare($dbConn, $requests_sql);
    mysqli_stmt_bind_param($stmt, "is", $_SESSION['user_id'], $current_filter);
    mysqli_stmt_execute($stmt);
    $requests_result = mysqli_stmt_get_result($stmt);
    
    if ($requests_result && mysqli_num_rows($requests_result) > 0) {
        while ($row = mysqli_fetch_assoc($requests_result)) {
            $userRequests[] = $row;
        }
    }
}

$acceptedOffers = [];
if ($current_filter === 'accepted_offers') {
    $accepted_sql = "SELECT ed.*, pe.produce_name as original_produce, u1.user_name as from_user, u2.user_name as to_user
                     FROM exchange_details ed 
                     JOIN produceexchange pe ON ed.produce_id = pe.produce_id 
                     JOIN user u1 ON ed.from_user_id = u1.user_id 
                     JOIN user u2 ON ed.to_user_id = u2.user_id 
                     WHERE ed.offer_status = 'accepted' 
                     AND (ed.from_user_id = ? OR ed.to_user_id = ?)
                     ORDER BY ed.offer_id DESC";
    $stmt = mysqli_prepare($dbConn, $accepted_sql);
    mysqli_stmt_bind_param($stmt, "ii", $_SESSION['user_id'], $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $accepted_result = mysqli_stmt_get_result($stmt);
    
    if ($accepted_result && mysqli_num_rows($accepted_result) > 0) {
        while ($row = mysqli_fetch_assoc($accepted_result)) {
            $acceptedOffers[] = $row;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product'])) {
    $product = mysqli_real_escape_string($dbConn, $_POST['product']);
    $description = mysqli_real_escape_string($dbConn, $_POST['description']);
    $user_id = $_SESSION['user_id'];
    
    $insert_sql = "INSERT INTO produceexchange (user_id, produce_name, produce_description) 
                   VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($dbConn, $insert_sql);
    mysqli_stmt_bind_param($stmt, "iss", $user_id, $product, $description);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?action=listed&filter=" . $current_filter);
        exit();
    } else {
        $error_message = 'Error listing product. Please try again.';
    }
}

$success_message = '';
$error_message = $error_message ?? '';

if (isset($_GET['action'])) {
    if ($_GET['action'] === 'listed') {
        $success_message = 'Product listed successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TradeSwap - Product Trading Platform</title>
  <link rel="stylesheet" href="exchangehomegrownproduce.css">
</head>
<body>

<div class="container">
  <!-- Success and Error Messages -->
  <?php if ($success_message): ?>
    <div class="success-message">
      ✅ <?php echo htmlspecialchars($success_message); ?>
    </div>
  <?php endif; ?>
  
  <?php if ($error_message): ?>
    <div class="error-message">
      ❌ <?php echo htmlspecialchars($error_message); ?>
    </div>
  <?php endif; ?>

  <header class="tradeheader">
    <h1>Exchange Home Grown Produce</h1>
    <p class="subtitle">Trade fresh produce with the community!</p>
    <p class="tagline">Fresh, local, and sustainable trading</p>
  </header>

  <!-- Filter Dropdown -->
  <div class="filter-container">
    <label for="filterSelect" class="filter-label">View:</label>
    <select id="filterSelect" class="filter-dropdown" onchange="changeFilter(this.value)">
      <option value="listed" <?php echo $current_filter === 'listed' ? 'selected' : ''; ?>>Available Produce</option>
      <option value="my_listed" <?php echo $current_filter === 'my_listed' ? 'selected' : ''; ?>>My Listed Produce</option>
      <option value="pending" <?php echo $current_filter === 'pending' ? 'selected' : ''; ?>>My Pending Requests</option>
      <option value="accepted" <?php echo $current_filter === 'accepted' ? 'selected' : ''; ?>>My Accepted Requests</option>
      <option value="rejected" <?php echo $current_filter === 'rejected' ? 'selected' : ''; ?>>My Rejected Requests</option>
      <option value="accepted_offers" <?php echo $current_filter === 'accepted_offers' ? 'selected' : ''; ?>>All Accepted Trades</option>
    </select>
  </div>

  <div class="grid" id="offerGrid">
    <?php if ($current_filter === 'listed'): ?>
        <?php if (empty($availableProducts)): ?>
          <div class="empty-state">
            <h3>No Products Available</h3>
            <p>Be the first to list a product!</p>
          </div>
        <?php else: ?>
          <?php foreach ($availableProducts as $product): ?>
            <div class="card">
              <h3><?php echo htmlspecialchars($product['produce_name']); ?></h3>
              <p><?php echo htmlspecialchars($product['produce_description']); ?></p>
              <div class="posted-by">Posted by: <?php echo htmlspecialchars($product['posted_by']); ?></div>
              <div class="posted-date">Listed: <?php echo date('M j, Y g:i A', strtotime($product['created_at'])); ?></div>
              <button class="trade-btn" onclick="initiateTrade(<?php echo $product['produce_id']; ?>)">Propose Trade</button>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
    
    <?php elseif ($current_filter === 'my_listed'): ?>
        <?php if (empty($myListedProducts)): ?>
          <div class="empty-state">
            <h3>No Listed Products</h3>
            <p>You haven't listed any products yet. Click "List Your Product" to get started!</p>
          </div>
        <?php else: ?>
          <?php foreach ($myListedProducts as $product): ?>
            <div class="card">
              <h3><?php echo htmlspecialchars($product['produce_name']); ?></h3>
              <p><?php echo htmlspecialchars($product['produce_description']); ?></p>
              <div class="posted-by">
                Status: 
                <span class="trade-status status-<?php echo $product['status']; ?>" style="margin-left: 10px;">
                  <?php echo ucfirst($product['status']); ?>
                </span>
                <?php if ($product['offer_count'] > 0 && $product['status'] === 'available'): ?>
                  <span class="offer-count"><?php echo $product['offer_count']; ?> pending offers</span>
                <?php endif; ?>
              </div>
              <div class="posted-date">Listed: <?php echo date('M j, Y g:i A', strtotime($product['created_at'])); ?></div>
              <button class="view-btn" onclick="viewProductDetails(<?php echo $product['produce_id']; ?>)">
                View
              </button>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
    
    <?php elseif (in_array($current_filter, ['pending', 'accepted', 'rejected'])): ?>
        <?php if (empty($userRequests)): ?>
          <div class="empty-state">
            <h3>No <?php echo ucfirst($current_filter); ?> Requests</h3>
            <p>
                <?php if ($current_filter === 'pending'): ?>
                    You don't have any pending trade requests.
                <?php elseif ($current_filter === 'accepted'): ?>
                    You don't have any accepted trade requests.
                <?php else: ?>
                    You don't have any rejected trade requests.
                <?php endif; ?>
            </p>
          </div>
        <?php else: ?>
          <?php foreach ($userRequests as $request): ?>
            <div class="request-card <?php echo $current_filter; ?>">
              <div class="produce-info">
                <div class="trade-label">Produce You Wanted:</div>
                <div class="trade-value" style="font-weight: 600; font-size: 16px;"><?php echo htmlspecialchars($request['produce_name']); ?></div>
                <div class="trade-value"><?php echo htmlspecialchars($request['produce_description']); ?></div>
                <div class="trade-value">Owner: <?php echo htmlspecialchars($request['owner_name']); ?></div>
                <div class="trade-value">Produce Status: <?php echo ucfirst($request['produce_status']); ?></div>
              </div>
              
              <div class="request-details">
                <div class="trade-label">Your Offer:</div>
                <div class="trade-value" style="font-weight: 600; font-size: 16px;"><?php echo htmlspecialchars($request['offer_produce']); ?></div>
                <?php if (!empty($request['offer_producedescription'])): ?>
                  <div class="trade-value"><?php echo htmlspecialchars($request['offer_producedescription']); ?></div>
                <?php endif; ?>
              </div>
              
              <div class="trade-status status-<?php echo $current_filter; ?>">
                <?php echo ucfirst($current_filter); ?>
              </div>
              
              <?php if ($current_filter === 'pending'): ?>
                <div style="margin-top: 10px; font-size: 14px; color: #666;">
                  Waiting for owner to respond to your offer
                </div>
              <?php elseif ($current_filter === 'accepted'): ?>
                <div style="margin-top: 10px; font-size: 14px; color: #4CAF50;">
                  Trade successfully accepted!
                </div>
              <?php elseif ($current_filter === 'rejected'): ?>
                <div style="margin-top: 10px; font-size: 14px; color: #f44336;">
                  This trade offer was not accepted
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
    
    <?php elseif ($current_filter === 'accepted_offers'): ?>
        <?php if (empty($acceptedOffers)): ?>
          <div class="empty-state">
            <h3>No Accepted Trades Yet</h3>
            <p>Your accepted trades will appear here.</p>
          </div>
        <?php else: ?>
          <?php foreach ($acceptedOffers as $offer): ?>
            <div class="accepted-offer-card">
              <div class="trade-info">
                <div class="trade-party">
                  <div class="trade-label">Original Produce:</div>
                  <div class="trade-value"><?php echo htmlspecialchars($offer['original_produce']); ?></div>
                </div>
                <div class="trade-party">
                  <div class="trade-label">Offered Produce:</div>
                  <div class="trade-value"><?php echo htmlspecialchars($offer['offer_produce']); ?></div>
                </div>
              </div>
              
              <div class="trade-info">
                <div class="trade-party">
                  <div class="trade-label">From:</div>
                  <div class="trade-value"><?php echo htmlspecialchars($offer['from_user']); ?></div>
                </div>
                <div class="trade-party">
                  <div class="trade-label">To:</div>
                  <div class="trade-value"><?php echo htmlspecialchars($offer['to_user']); ?></div>
                </div>
              </div>
              
              <?php if (!empty($offer['offer_producedescription'])): ?>
                <div class="trade-party" style="grid-column: 1 / -1;">
                  <div class="trade-label">Offer Description:</div>
                  <div class="trade-value"><?php echo htmlspecialchars($offer['offer_producedescription']); ?></div>
                </div>
              <?php endif; ?>
              
              <div class="trade-status status-accepted">Trade Accepted</div>
              
              <?php if ($offer['from_user_id'] == $_SESSION['user_id']): ?>
                <div style="margin-top: 10px; font-size: 14px; color: #4CAF50;">
                  ✅ You initiated this trade
                </div>
              <?php else: ?>
                <div style="margin-top: 10px; font-size: 14px; color: #2196F3;">
                  📥 You received this trade offer
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
  </div>

  <?php if ($current_filter === 'listed' || $current_filter === 'my_listed'): ?>
    <button class="list-btn" onclick="openForm()">List Your Product</button>
  <?php endif; ?>
</div>

<!-- Product Listing Form -->
<div id="offerForm" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeForm()">&times;</span>
    <h3>List Your Product</h3>
    <form id="offerFormData" method="POST">
      <label for="product">Product Name:</label>
      <input type="text" id="product" name="product" placeholder="e.g., Organic Tomatoes" required>

      <label for="description">Description:</label>
      <textarea id="description" name="description" placeholder="Describe your product..." rows="3" required></textarea>

      <button type="submit">List Product</button>
    </form>
  </div>
</div>

<script>
  function changeFilter(filter) {
    window.location.href = 'exchangehomegrownproduce.php?filter=' + filter;
  }

  function initiateTrade(productId) {
    window.location.href = 'exchangedetails.php?produce_id=' + productId;
  }

  function viewProductDetails(productId) {
    window.location.href = 'exchangedetails.php?produce_id=' + productId;
  }

  function openForm() {
    document.getElementById("offerForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("offerForm").style.display = "none";
  }

  window.onclick = function(event) {
    const modal = document.getElementById('offerForm');
    if (event.target === modal) {
      closeForm();
    }
  }

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
    
    if (window.history.replaceState && (window.location.search.includes('action=') || window.location.search.includes('filter='))) {
      const url = new URL(window.location);
      url.searchParams.delete('action');
      window.history.replaceState(null, null, url.pathname + '?filter=<?php echo $current_filter; ?>');
    }
  });
</script>

<?php include "../../footer.php"?>

</body>
</html>