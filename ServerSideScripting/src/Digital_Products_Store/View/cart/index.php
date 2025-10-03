<?php
$currentPage = 'cart';
$pageTitle = 'Shopping Cart';

ob_start();
?>

<h1 style="font-size: 2.5rem; font-weight: 300; color: rgba(255, 255, 255, 0.9); margin-bottom: 3rem; text-align: center;">Shopping Cart</h1>

<?php if (count($cartItems) > 0): ?>
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; align-items: start;">
        <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border-radius: 16px; padding: 2rem;">
            <?php foreach ($cartItems as $item): ?>
                <div style="display: grid; grid-template-columns: 120px 1fr auto auto; gap: 1.5rem; align-items: center; padding: 2rem 0; border-bottom: 1px dashed rgba(255, 255, 255, 0.2);">
                    <div style="width: 120px; height: 120px; border-radius: 12px; overflow: hidden; background: rgba(255, 255, 255, 0.1); display: flex; align-items: center; justify-content: center;">
                        <?php if ($item['product']['image_url']): ?>
                            <img src="<?php echo htmlspecialchars($item['product']['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($item['product']['name']); ?>" 
                                 style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #ff8a50, #ff6b9d, #c44569, #8b5fbf); color: white; font-weight: 600; font-size: 1.2rem;">
                                <?php echo strtoupper(substr($item['product']['code'], 0, 4)); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <div style="font-size: 0.85rem; color: rgba(255, 255, 255, 0.7); text-transform: uppercase; letter-spacing: 0.5px; font-weight: 500;"><?php echo htmlspecialchars($item['product']['category_name']); ?></div>
                        <h3 style="font-size: 1.1rem; font-weight: 600; color: rgba(255, 255, 255, 0.95); margin: 0.5rem 0;"><?php echo htmlspecialchars($item['product']['name']); ?></h3>
                        <div style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.6);">Code: <?php echo htmlspecialchars($item['product']['code']); ?></div>
                    </div>
                    
                    <button type="button" class="remove-item" 
                            data-product-id="<?php echo $item['product']['id']; ?>"
                            style="background: none; border: none; color: rgba(255, 255, 255, 0.6); font-size: 1.2rem; cursor: pointer; padding: 0.5rem; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        ×
                    </button>
                    
                    <div style="text-align: right; font-size: 1.2rem; font-weight: 600; color: rgba(255, 255, 255, 0.95);">
                        $<?php echo number_format($item['total'], 2); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border-radius: 16px; padding: 2rem; position: sticky; top: 120px;">
            <h3 style="font-size: 1.3rem; font-weight: 600; color: rgba(255, 255, 255, 0.95); margin-bottom: 1.5rem;">Order Summary</h3>
            
            <div style="margin-bottom: 2rem;">
                <label style="font-size: 0.9rem; color: rgba(255, 255, 255, 0.7); margin-bottom: 0.5rem; display: block;">enter promo code or gift card number</label>
                <input type="text" placeholder="Enter code" style="width: 100%; padding: 0.75rem; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 8px; font-size: 0.95rem; background: rgba(255, 255, 255, 0.1); color: white;">
            </div>
            
            <div style="margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 0.95rem; color: rgba(255, 255, 255, 0.8);">
                    <span>subtotal:</span>
                    <span>$<?php echo number_format($cartTotal, 2); ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; font-size: 0.95rem; color: rgba(255, 255, 255, 0.8);">
                    <span>estimated shipping:</span>
                    <span>$0.00</span>
                </div>
                <div style="display: flex; justify-content: space-between; font-size: 1.2rem; font-weight: 600; color: rgba(255, 255, 255, 0.95); padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.2);">
                    <span>total:</span>
                    <span>$<?php echo number_format($cartTotal, 2); ?></span>
                </div>
            </div>
            
            <button type="button" id="checkout-btn" style="width: 100%; background: rgba(255, 255, 255, 0.2); color: white; border: 1px solid rgba(255, 255, 255, 0.3); padding: 1rem 2rem; border-radius: 8px; font-size: 1rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; cursor: pointer;">
                checkout
            </button>
        </div>
    </div>
<?php else: ?>
    <div style="text-align: center; padding: 4rem 2rem; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); border-radius: 16px;">
        <div style="font-size: 4rem; margin-bottom: 1.5rem; opacity: 0.6;">🛒</div>
        <h3 style="font-size: 1.5rem; font-weight: 600; color: rgba(255, 255, 255, 0.95); margin-bottom: 1rem;">Your cart is empty</h3>
        <p style="color: rgba(255, 255, 255, 0.7); margin-bottom: 2rem;">Add some amazing digital products to get started!</p>
        <a href="mvc.php" style="background: rgba(255, 255, 255, 0.2); color: white; text-decoration: none; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 600; border: 1px solid rgba(255, 255, 255, 0.3);">Browse Products</a>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();

$additionalJS = '
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".remove-item").forEach(btn => {
            btn.addEventListener("click", function() {
                const productId = this.dataset.productId;
                const originalText = this.textContent;
                
                this.textContent = "×";
                this.disabled = true;
                
                fetch("mvc.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `action=remove&product_id=${productId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the item from the DOM
                        this.closest("div[style*=\"grid-template-columns: 120px 1fr auto auto\"]").remove();
                        
                        // Update cart count in header
                        const cartCountElement = document.getElementById("cartCount");
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }
                        
                        // Reload page if cart is empty
                        if (data.cartCount == 0) {
                            location.reload();
                        }
                    } else {
                        this.textContent = originalText;
                        this.disabled = false;
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    this.textContent = originalText;
                    this.disabled = false;
                    alert("An error occurred");
                });
            });
        });
    });
';

include __DIR__ . '/../layout/base.php';
?>

