<?php
$title = 'Virtual Flower Arrangement - PetalNest';
include 'includes/header.php';
?>
<section class="virtual-arrangement">
    <div class="container">
        <h2 class="section-title">Create Your Own Bouquet 🎨</h2>
        <p class="section-subtitle">Design your perfect flower arrangement with our virtual tool</p>
        
        <div class="virtual-arrangement-container">
            <div class="arrangement-canvas" id="arrangement-canvas"></div>
            
            <div class="flower-palette">
                <h3>Flower Palette</h3>
                <div class="flower-options">
                    <div class="flower-option" data-flower="🌹" title="Rose">🌹</div>
                    <div class="flower-option" data-flower="🌸" title="Cherry Blossom">🌸</div>
                    <div class="flower-option" data-flower="🌷" title="Tulip">🌷</div>
                    <div class="flower-option" data-flower="🌺" title="Hibiscus">🌺</div>
                    <div class="flower-option" data-flower="🌻" title="Sunflower">🌻</div>
                    <div class="flower-option" data-flower="🌼" title="Daisy">🌼</div>
                    <div class="flower-option" data-flower="💐" title="Bouquet">💐</div>
                    <div class="flower-option" data-flower="🌿" title="Leaves">🌿</div>
                    <div class="flower-option" data-flower="🌾" title="Wheat">🌾</div>
                    <div class="flower-option" data-flower="🍀" title="Clover">🍀</div>
                </div>
                
                <div class="arrangement-tools">
                    <h3>Tools</h3>
                    <div class="tool-options">
                        <div class="tool-option" data-tool="move" title="Move">
                            <i class="fas fa-arrows-alt"></i>
                        </div>
                        <div class="tool-option" data-tool="delete" title="Delete">
                            <i class="fas fa-trash"></i>
                        </div>
                        <div class="tool-option" data-tool="resize" title="Resize">
                            <i class="fas fa-expand-arrows-alt"></i>
                        </div>
                        <div class="tool-option" data-tool="rotate" title="Rotate">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                    </div>
                </div>
                
                <div class="arrangement-actions">
                    <button class="btn" id="clear-arrangement">Clear All</button>
                    <button class="btn" id="save-arrangement">Save Arrangement</button>
                    <button class="btn" id="order-arrangement">Order This Arrangement</button>
                </div>
                
                <div class="arrangement-info">
                    <h3>Tips</h3>
                    <ul>
                        <li>Select a flower from the palette and click on the canvas to add it</li>
                        <li>Use the tools to move, resize, or delete flowers</li>
                        <li>Create a balanced arrangement with different colors and sizes</li>
                        <li>Save your arrangement to order later or share with friends</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="arrangement-gallery">
            <h3>Inspiration Gallery</h3>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="assets/images/arrangement1.jpg" alt="Flower Arrangement">
                    <div class="gallery-overlay">
                        <h4>Spring Delight</h4>
                        <button class="btn load-arrangement" data-arrangement="spring">Load</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/arrangement2.jpg" alt="Flower Arrangement">
                    <div class="gallery-overlay">
                        <h4>Summer Bliss</h4>
                        <button class="btn load-arrangement" data-arrangement="summer">Load</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/arrangement3.jpg" alt="Flower Arrangement">
                    <div class="gallery-overlay">
                        <h4>Autumn Warmth</h4>
                        <button class="btn load-arrangement" data-arrangement="autumn">Load</button>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="assets/images/arrangement4.jpg" alt="Flower Arrangement">
                    <div class="gallery-overlay">
                        <h4>Winter Elegance</h4>
                        <button class="btn load-arrangement" data-arrangement="winter">Load</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>