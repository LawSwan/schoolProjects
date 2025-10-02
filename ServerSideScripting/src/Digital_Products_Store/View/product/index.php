<?php
$currentPage = 'home';
$pageTitle = isset($title) ? $title : 'Dynamic carousel';
$pageSubtitle = 'Handpicked digital products to boost your creativity';

$additionalCSS = '
    .elegant-store-title {
        font-size: 3.5rem;
        font-weight: 300;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1rem;
        text-align: center;
        letter-spacing: -2px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .elegant-store-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.7);
        text-align: center;
        margin-bottom: 4rem;
        font-weight: 300;
        letter-spacing: 0.5px;
    }
    .elegant-products-carousel {
        position: relative;
        overflow: hidden;
        padding: 2rem 0;
    }
    .elegant-carousel-container {
        display: flex;
        gap: 2rem;
        transition: transform 0.5s ease;
        padding: 0 1rem;
    }
    .elegant-carousel-item {
        flex: 0 0 350px;
        position: relative;
    }
    .elegant-carousel-item.center {
        transform: scale(1.05);
        z-index: 2;
    }
    .elegant-carousel-item.side {
        transform: scale(0.9);
        opacity: 0.7;
    }
    .elegant-carousel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        font-size: 1.5rem;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        z-index: 3;
    }
    .elegant-carousel-nav:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-50%) scale(1.1);
    }
    .elegant-carousel-prev {
        left: 1rem;
    }
    .elegant-carousel-next {
        right: 1rem;
    }
    .elegant-product-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.4s ease;
        height: 100%;
    }
    .elegant-product-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 16px 48px rgba(0,0,0,0.2);
        border-color: rgba(255, 255, 255, 0.3);
    }
    .elegant-product-image-carousel {
        width: 100%;
        height: 250px;
        position: relative;
        overflow: hidden;
        border-radius: 20px 20px 0 0;
    }
    .elegant-product-image-container {
        display: flex;
        width: 100%;
        height: 100%;
        transition: transform 0.5s ease;
    }
    .elegant-product-image {
        width: 100%;
        height: 100%;
        flex-shrink: 0;
        background: rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .elegant-product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .elegant-product-card:hover .elegant-product-image img {
        transform: scale(1.05);
    }
    .elegant-product-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #ff8a50, #ff6b9d, #c44569, #8b5fbf);
        color: white;
        font-weight: 600;
        font-size: 1.5rem;
    }
    .elegant-product-image-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.3);
        border: none;
        color: white;
        font-size: 1rem;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0;
        z-index: 2;
    }
    .elegant-product-card:hover .elegant-product-image-nav {
        opacity: 1;
    }
    .elegant-product-image-nav:hover {
        background: rgba(0, 0, 0, 0.5);
        transform: translateY(-50%) scale(1.1);
    }
    .elegant-product-image-prev {
        left: 0.5rem;
    }
    .elegant-product-image-next {
        right: 0.5rem;
    }
    .elegant-product-image-dots {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 0.5rem;
        z-index: 2;
    }
    .elegant-product-image-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .elegant-product-image-dot.active {
        background: rgba(255, 255, 255, 0.9);
        transform: scale(1.2);
    }
    .elegant-product-info {
        padding: 2rem;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }
    .elegant-product-category {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.7);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }
    .elegant-product-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.95);
        margin: 0 0 1rem 0;
        line-height: 1.3;
    }
    .elegant-product-description {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }
    .elegant-product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .elegant-product-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: rgba(255, 255, 255, 0.95);
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .elegant-product-size {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 0.25rem;
    }
    .elegant-add-to-cart {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    .elegant-add-to-cart:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    /* Dark Academia Special Styling for DAPIC Image */
    .elegant-product-card[data-product-name="Dark Academia"] {
        background: linear-gradient(135deg, rgba(75, 0, 130, 0.3), rgba(25, 25, 112, 0.3));
        border: 2px solid rgba(255, 215, 0, 0.3);
        box-shadow: 0 8px 32px rgba(75, 0, 130, 0.2), 0 0 20px rgba(255, 215, 0, 0.1);
    }
    
    .elegant-product-card[data-product-name="Dark Academia"]:hover {
        border-color: rgba(255, 215, 0, 0.6);
        box-shadow: 0 16px 48px rgba(75, 0, 130, 0.3), 0 0 30px rgba(255, 215, 0, 0.2);
        transform: translateY(-8px) scale(1.02);
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-product-image {
        position: relative;
        overflow: hidden;
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-product-image::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, 
            rgba(75, 0, 130, 0.1) 0%, 
            rgba(25, 25, 112, 0.1) 50%, 
            rgba(255, 215, 0, 0.05) 100%);
        z-index: 1;
        pointer-events: none;
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-product-image img {
        filter: contrast(1.1) saturate(1.2) brightness(0.95);
        transition: all 0.4s ease;
    }
    
    .elegant-product-card[data-product-name="Dark Academia"]:hover .elegant-product-image img {
        filter: contrast(1.2) saturate(1.3) brightness(1.05);
        transform: scale(1.08);
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-product-title {
        background: linear-gradient(45deg, #FFD700, #DAA520, #B8860B);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-product-category {
        color: rgba(255, 215, 0, 0.8);
        font-weight: 600;
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-product-price {
        color: #FFD700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-add-to-cart {
        background: linear-gradient(135deg, rgba(75, 0, 130, 0.4), rgba(25, 25, 112, 0.4));
        border: 1px solid rgba(255, 215, 0, 0.4);
        color: #FFD700;
        font-weight: 600;
    }
    
    .elegant-product-card[data-product-name="Dark Academia"] .elegant-add-to-cart:hover {
        background: linear-gradient(135deg, rgba(75, 0, 130, 0.6), rgba(25, 25, 112, 0.6));
        border-color: rgba(255, 215, 0, 0.7);
        box-shadow: 0 4px 20px rgba(255, 215, 0, 0.2);
    }
    ';

$additionalJS = '
    document.addEventListener("DOMContentLoaded", function() {
        let currentIndex = 1;
        const carouselContainer = document.getElementById("carouselContainer");
        const carouselItems = document.querySelectorAll(".elegant-carousel-item");
        const prevBtn = document.getElementById("carouselPrev");
        const nextBtn = document.getElementById("carouselNext");
        
        function updateCarousel() {
            carouselItems.forEach((item, index) => {
                item.classList.remove("center", "side");
                if (index === currentIndex) {
                    item.classList.add("center");
                } else {
                    item.classList.add("side");
                }
            });
        }
        
        if (prevBtn && nextBtn) {
            prevBtn.addEventListener("click", () => {
                currentIndex = (currentIndex - 1 + carouselItems.length) % carouselItems.length;
                updateCarousel();
            });
            
            nextBtn.addEventListener("click", () => {
                currentIndex = (currentIndex + 1) % carouselItems.length;
                updateCarousel();
            });
        }
        
        document.querySelectorAll(".elegant-product-image-nav").forEach(button => {
            button.addEventListener("click", function() {
                const productId = this.dataset.productId;
                const container = document.getElementById(`productCarousel${productId}`);
                const images = container.querySelectorAll(".elegant-product-image");
                const dots = document.querySelectorAll(`[data-product-id="${productId}"].elegant-product-image-dot`);
                
                let currentImageIndex = 0;
                images.forEach((img, index) => {
                    if (img.style.transform === "translateX(0px)" || index === 0) {
                        currentImageIndex = index;
                    }
                });
                
                if (this.classList.contains("elegant-product-image-prev")) {
                    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                } else {
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                }
                
                container.style.transform = `translateX(-${currentImageIndex * 100}%)`;
                
                dots.forEach((dot, index) => {
                    dot.classList.toggle("active", index === currentImageIndex);
                });
            });
        });
        
        document.querySelectorAll(".elegant-product-image-dot").forEach(dot => {
            dot.addEventListener("click", function() {
                const productId = this.dataset.productId;
                const index = parseInt(this.dataset.index);
                const container = document.getElementById(`productCarousel${productId}`);
                const dots = document.querySelectorAll(`[data-product-id="${productId}"].elegant-product-image-dot`);
                
                container.style.transform = `translateX(-${index * 100}%)`;
                
                dots.forEach(d => d.classList.remove("active"));
                this.classList.add("active");
            });
        });
        
        document.querySelectorAll(".add-to-cart-simple").forEach(btn => {
            btn.addEventListener("click", function() {
                const productId = this.dataset.productId;
                const originalText = this.textContent;
                
                this.textContent = "Adding...";
                this.disabled = true;
                
                fetch("/Digital_Products_Store/cart/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: `product_id=${productId}&quantity=1`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const cartCountElement = document.getElementById("cartCount");
                        if (cartCountElement) {
                            cartCountElement.textContent = data.cartCount;
                        }
                        
                        this.textContent = "Added!";
                        this.style.background = "rgba(76, 175, 80, 0.8)";
                        
                        showMessage(data.message, "success");
                        
                        setTimeout(() => {
                            this.textContent = originalText;
                            this.disabled = false;
                            this.style.background = "";
                        }, 2000);
                    } else {
                        this.textContent = originalText;
                        this.disabled = false;
                        showMessage(data.message, "error");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    this.textContent = originalText;
                    this.disabled = false;
                    showMessage("An error occurred", "error");
                });
            });
        });
        
        function showMessage(message, type) {
            let messageEl = document.querySelector(".elegant-message");
            if (!messageEl) {
                messageEl = document.createElement("div");
                messageEl.className = "elegant-message";
                document.querySelector(".elegant-main").insertBefore(messageEl, document.querySelector(".elegant-products-carousel"));
            }
            
            messageEl.textContent = message;
            messageEl.className = `elegant-message ${type}`;
            
            setTimeout(() => {
                messageEl.remove();
            }, 3000);
        }
    });
';

ob_start();
?>

<h1 class="elegant-store-title"><?php echo htmlspecialchars($pageTitle); ?></h1>
<p class="elegant-store-subtitle"><?php echo htmlspecialchars($pageSubtitle); ?></p>

<div class="elegant-products-carousel">
    <button class="elegant-carousel-nav elegant-carousel-prev" id="carouselPrev">‹</button>
    <button class="elegant-carousel-nav elegant-carousel-next" id="carouselNext">›</button>
    
    <div class="elegant-carousel-container" id="carouselContainer">
    <?php foreach ($products as $index => $product): ?>
        <div class="elegant-carousel-item <?php echo $index === 1 ? 'center' : 'side'; ?>" data-index="<?php echo $index; ?>">
            <div class="elegant-product-card" data-product-name="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="elegant-product-image-carousel">
                    <div class="elegant-product-image-container" id="productCarousel<?php echo $product['id']; ?>">
                        <?php 
                        $productImages = [];
                        if ($product['image_url'] && !empty($product['image_url'])) {
                            $productImages[] = $product['image_url'];
                            $productImages[] = $product['image_url'];
                            $productImages[] = $product['image_url'];
                        }
                        
                        if (!empty($productImages)):
                            foreach ($productImages as $imgIndex => $image): ?>
                                <div class="elegant-product-image">
                                    <img src="<?php echo htmlspecialchars($image); ?>" 
                                         alt="<?php echo htmlspecialchars($product['name']); ?>">
                                </div>
                            <?php endforeach;
                        else: ?>
                            <div class="elegant-product-image">
                                <div class="elegant-product-placeholder">
                                    <?php echo strtoupper(substr($product['code'], 0, 4)); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (count($productImages) > 1): ?>
                        <button class="elegant-product-image-nav elegant-product-image-prev" 
                                data-product-id="<?php echo $product['id']; ?>">‹</button>
                        <button class="elegant-product-image-nav elegant-product-image-next" 
                                data-product-id="<?php echo $product['id']; ?>">›</button>
                        
                        <div class="elegant-product-image-dots">
                            <?php for ($i = 0; $i < count($productImages); $i++): ?>
                                <div class="elegant-product-image-dot <?php echo $i === 0 ? 'active' : ''; ?>" 
                                     data-product-id="<?php echo $product['id']; ?>" 
                                     data-index="<?php echo $i; ?>"></div>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
                <div class="elegant-product-info">
                    <div class="elegant-product-category"><?php echo htmlspecialchars($product['category_name']); ?></div>
                    <h3 class="elegant-product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p class="elegant-product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                    <div class="elegant-product-footer">
                        <div>
                            <div class="elegant-product-price">$<?php echo number_format($product['price'], 2); ?></div>
                            <div class="elegant-product-size"><?php echo htmlspecialchars($product['file_size']); ?></div>
                        </div>
                        <button type="button" class="elegant-add-to-cart add-to-cart-simple" 
                                data-product-id="<?php echo $product['id']; ?>">
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout/base.php';
?>

