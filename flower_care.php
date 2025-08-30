<?php
$title = 'Flower Care Guide - PetalNest';
include 'includes/header.php';
?>
<section class="flower-care-section">
    <div class="container">
        <h2 class="section-title">Flower Care Guide 🌸</h2>
        <p style="text-align: center; margin-bottom: 40px; font-size: 1.2em;">Learn how to take care of your flowers and plants to keep them fresh and beautiful</p>
        
        <div class="care-tips-grid">
            <div class="care-tip-card">
                <div class="care-tip-icon">💧</div>
                <h3>Watering</h3>
                <p>Most flowers need regular watering, but avoid overwatering. Check soil moisture before watering. Different plants have different water needs - research your specific plant for best results.</p>
            </div>
            
            <div class="care-tip-card">
                <div class="care-tip-icon">☀️</div>
                <h3>Sunlight</h3>
                <p>Place flowers where they can enjoy the right amount of sunlight. Most flowers need 4-6 hours of direct sunlight, while some prefer indirect light. Too much direct sun can scorch leaves and flowers.</p>
            </div>
            
            <div class="care-tip-card">
                <div class="care-tip-icon">🌱</div>
                <h3>Soil Care</h3>
                <p>Use nutrient-rich soil to keep your plants healthy and vibrant. Replace soil every 6-12 months. Good drainage is essential to prevent root rot.</p>
            </div>
            
            <div class="care-tip-card">
                <div class="care-tip-icon">✂️</div>
                <h3>Pruning</h3>
                <p>Trim old leaves and blooms to encourage fresh growth. Remove dead or dying flowers regularly. Pruning helps maintain plant shape and promotes healthier growth.</p>
            </div>
            
            <div class="care-tip-card">
                <div class="care-tip-icon">🌡️</div>
                <h3>Temperature</h3>
                <p>Most flowers prefer temperatures between 65-75°F (18-24°C). Avoid placing plants near drafts, heaters, or air conditioners. Sudden temperature changes can stress plants.</p>
            </div>
            
            <div class="care-tip-card">
                <div class="care-tip-icon">🌿</div>
                <h3>Fertilizing</h3>
                <p>Feed your plants with appropriate fertilizer during growing season. Follow package instructions carefully - too much fertilizer can damage roots. Organic fertilizers are often gentler on plants.</p>
            </div>
        </div>
        
        <div class="flower-specific-care">
            <h3>Specific Flower Care Guides</h3>
            <div class="flower-care-tabs">
                <div class="flower-care-tab active" data-flower="roses">Roses</div>
                <div class="flower-care-tab" data-flower="tulips">Tulips</div>
                <div class="flower-care-tab" data-flower="lilies">Lilies</div>
                <div class="flower-care-tab" data-flower="orchids">Orchids</div>
                <div class="flower-care-tab" data-flower="sunflowers">Sunflowers</div>
            </div>
            
            <div class="flower-care-content">
                <div class="flower-care-info active" id="roses-care">
                    <h4>Rose Care</h4>
                    <p>Roses need at least 6 hours of direct sunlight daily. Water deeply once a week, more in hot weather. Prune in early spring to remove dead wood and shape the plant. Feed with rose fertilizer every 4-6 weeks during growing season.</p>
                </div>
                
                <div class="flower-care-info" id="tulips-care">
                    <h4>Tulip Care</h4>
                    <p>Tulips prefer cool temperatures and bright light. Water when the top inch of soil is dry. After flowering, let the foliage die back naturally to replenish the bulbs for next year. Plant bulbs in fall for spring blooms.</p>
                </div>
                
                <div class="flower-care-info" id="lilies-care">
                    <h4>Lily Care</h4>
                    <p>Lilies need well-draining soil and full sun to partial shade. Water regularly but don't let soil become waterlogged. Remove faded flowers to prevent seed formation. Mulch in winter to protect bulbs in colder climates.</p>
                </div>
                
                <div class="flower-care-info" id="orchids-care">
                    <h4>Orchid Care</h4>
                    <p>Orchids prefer bright, indirect light and high humidity. Water once a week, allowing water to drain completely. Use special orchid potting mix. Fertilize monthly with orchid fertilizer at half strength.</p>
                </div>
                
                <div class="flower-care-info" id="sunflowers-care">
                    <h4>Sunflower Care</h4>
                    <p>Sunflowers need full sun and well-draining soil. Water deeply but infrequently to encourage deep root growth. Stake tall varieties to prevent them from falling over. Harvest seeds when the back of the flower head turns brown.</p>
                </div>
            </div>
        </div>
        
        <div class="common-problems">
            <h3>Common Flower Problems & Solutions</h3>
            <div class="problems-grid">
                <div class="problem-card">
                    <h4>Yellow Leaves</h4>
                    <p>Usually caused by overwatering or poor drainage. Allow soil to dry between waterings and ensure pots have drainage holes.</p>
                </div>
                
                <div class="problem-card">
                    <h4>Pests</h4>
                    <p>Common pests include aphids, spider mites, and mealybugs. Use insecticidal soap or neem oil for treatment. Isolate infected plants to prevent spread.</p>
                </div>
                
                <div class="problem-card">
                    <h4>Wilting</h4>
                    <p>Can be caused by underwatering, overwatering, or root rot. Check soil moisture and adjust watering accordingly. Ensure proper drainage.</p>
                </div>
                
                <div class="problem-card">
                    <h4>No Blooms</h4>
                    <p>May be due to insufficient light, improper fertilizing, or wrong pruning schedule. Ensure proper care for your specific plant type.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.flower-care-tab');
    const contents = document.querySelectorAll('.flower-care-info');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const flower = this.getAttribute('data-flower');
            
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            contents.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            document.getElementById(flower + '-care').classList.add('active');
        });
    });
});
</script>

<?php include 'includes/footer.php'; ?>