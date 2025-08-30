document.addEventListener('DOMContentLoaded', function() {
    // Hide loader when page is loaded
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('loader').style.display = 'none';
        }, 1000);
    });
    
    // Set greeting based on time of day
    const hour = new Date().getHours();
    let greeting = "Good day";
    
    if (hour < 12) {
        greeting = "Good morning";
    } else if (hour < 18) {
        greeting = "Good afternoon";
    } else {
        greeting = "Good evening";
    }
    
    const greetingText = document.getElementById('greeting-text');
    if (greetingText) {
        greetingText.textContent = `${greeting}! Welcome to PetalNest! 🌸`;
    }
    
    // Dropdown menu functionality
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdown = this.nextElementSibling;
            
            // Close all other dropdowns
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdown) {
                    menu.classList.remove('show');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('show');
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
    
    // Subscription functionality
    const subscribeButtons = document.querySelectorAll('.subscribe-btn');
    subscribeButtons.forEach(button => {
        button.addEventListener('click', function() {
            const planName = this.closest('.subscription-box').querySelector('h3').textContent;
            
            // Create a simple modal or alert for subscription
            const modal = document.createElement('div');
            modal.className = 'subscription-modal';
            modal.innerHTML = `
                <div class="modal-content">
                    <span class="close-modal">&times;</span>
                    <h3>Subscribe to ${planName}</h3>
                    <p>Please login or register to subscribe to our ${planName} plan.</p>
                    <div class="modal-actions">
                        <a href="login.php" class="btn">Login</a>
                        <a href="register.php" class="btn">Register</a>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            
            // Close modal when clicking on X
            modal.querySelector('.close-modal').addEventListener('click', function() {
                modal.remove();
            });
            
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.remove();
                }
            });
        });
    });
    
    // Add to Cart functionality
    const addToCartButtons = document.querySelectorAll('.btn-add-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            
            // Create a simple notification
            const notification = document.createElement('div');
            notification.className = 'cart-notification';
            notification.textContent = 'Adding to cart...';
            document.body.appendChild(notification);
            
            // Send AJAX request to add to cart
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `cart.php?add=${productId}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    notification.textContent = 'Product added to cart!';
                    notification.style.backgroundColor = '#4CAF50';
                    
                    // Update cart count
                    const cartCountElements = document.querySelectorAll('.fa-shopping-cart').forEach(cartIcon => {
                        const cartCount = cartIcon.nextElementSibling;
                        if (cartCount) {
                            const currentCount = parseInt(cartCount.textContent.replace(/[()]/g, '')) || 0;
                            cartCount.textContent = `(${currentCount + 1})`;
                        }
                    });
                    
                    // Redirect to cart after a short delay
                    setTimeout(function() {
                        window.location.href = 'cart.php';
                    }, 1500);
                } else {
                    notification.textContent = 'Failed to add product to cart.';
                    notification.style.backgroundColor = '#f44336';
                }
                
                setTimeout(function() {
                    notification.remove();
                }, 3000);
            };
            xhr.send();
        });
    });
    
    // Wishlist functionality
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    wishlistButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            
            // Toggle active state
            this.classList.toggle('active');
            
            // Create a simple notification
            const notification = document.createElement('div');
            notification.className = 'wishlist-notification';
            
            if (this.classList.contains('active')) {
                notification.textContent = 'Added to wishlist!';
                notification.style.backgroundColor = '#4CAF50';
                
                // Send AJAX request to add to wishlist
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `wishlist.php?add=${productId}`, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Update wishlist count
                        const wishlistCountElements = document.querySelectorAll('.fa-heart').forEach(heartIcon => {
                            const wishlistCount = heartIcon.nextElementSibling;
                            if (wishlistCount) {
                                const currentCount = parseInt(wishlistCount.textContent.replace(/[()]/g, '')) || 0;
                                wishlistCount.textContent = `(${currentCount + 1})`;
                            }
                        });
                    }
                };
                xhr.send();
            } else {
                notification.textContent = 'Removed from wishlist!';
                notification.style.backgroundColor = '#ff9800';
                
                // Send AJAX request to remove from wishlist
                const xhr = new XMLHttpRequest();
                xhr.open('GET', `wishlist.php?remove=${productId}`, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Update wishlist count
                        const wishlistCountElements = document.querySelectorAll('.fa-heart').forEach(heartIcon => {
                            const wishlistCount = heartIcon.nextElementSibling;
                            if (wishlistCount) {
                                const currentCount = parseInt(wishlistCount.textContent.replace(/[()]/g, '')) || 0;
                                wishlistCount.textContent = `(${Math.max(0, currentCount - 1)})`;
                            }
                        });
                    }
                };
                xhr.send();
            }
            
            document.body.appendChild(notification);
            
            setTimeout(function() {
                notification.remove();
            }, 3000);
        });
    });
    
    // Compare functionality
    const compareButtons = document.querySelectorAll('.compare-btn');
    let compareProducts = [];
    
    compareButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            const productName = this.getAttribute('data-name');
            const productPrice = this.getAttribute('data-price');
            const productImage = this.getAttribute('data-image');
            
            // Toggle active state
            this.classList.toggle('active');
            
            if (this.classList.contains('active')) {
                // Add to compare
                compareProducts.push({
                    id: productId,
                    name: productName,
                    price: productPrice,
                    image: productImage
                });
                
                // Create a simple notification
                const notification = document.createElement('div');
                notification.className = 'compare-notification';
                notification.textContent = `${productName} added to compare!`;
                notification.style.backgroundColor = '#4CAF50';
                document.body.appendChild(notification);
                
                setTimeout(function() {
                    notification.remove();
                }, 3000);
            } else {
                // Remove from compare
                compareProducts = compareProducts.filter(p => p.id !== productId);
                
                // Create a simple notification
                const notification = document.createElement('div');
                notification.className = 'compare-notification';
                notification.textContent = `${productName} removed from compare!`;
                notification.style.backgroundColor = '#ff9800';
                document.body.appendChild(notification);
                
                setTimeout(function() {
                    notification.remove();
                }, 3000);
            }
            
            // Update compare section
            updateCompareSection();
        });
    });
    
    function updateCompareSection() {
        const compareSection = document.querySelector('.compare-section');
        const compareProductsContainer = document.querySelector('.compare-products');
        
        if (compareProducts.length > 0) {
            compareSection.style.display = 'block';
            compareProductsContainer.innerHTML = '';
            
            compareProducts.forEach(product => {
                const productCard = document.createElement('div');
                productCard.className = 'compare-product-card';
                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <h4>${product.name}</h4>
                    <p>$${product.price}</p>
                    <button class="btn-remove-compare" data-id="${product.id}">Remove</button>
                `;
                compareProductsContainer.appendChild(productCard);
                
                // Add remove functionality
                productCard.querySelector('.btn-remove-compare').addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    compareProducts = compareProducts.filter(p => p.id !== productId);
                    
                    // Update button state
                    document.querySelector(`.compare-btn[data-id="${productId}"]`).classList.remove('active');
                    
                    // Update compare section
                    updateCompareSection();
                });
            });
        } else {
            compareSection.style.display = 'none';
        }
    }
    
    // Virtual Arrangement functionality
    const flowerOptions = document.querySelectorAll('.flower-option');
    const arrangementCanvas = document.getElementById('arrangement-canvas');
    let selectedFlower = null;
    let arrangementItems = [];
    
    flowerOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            flowerOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Set selected flower
            selectedFlower = this.getAttribute('data-flower');
        });
    });
    
    if (arrangementCanvas) {
        arrangementCanvas.addEventListener('click', function(e) {
            if (selectedFlower) {
                const rect = arrangementCanvas.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                // Create flower element
                const flowerElement = document.createElement('div');
                flowerElement.className = 'arrangement-flower';
                flowerElement.textContent = selectedFlower;
                flowerElement.style.left = `${x}px`;
                flowerElement.style.top = `${y}px`;
                flowerElement.style.position = 'absolute';
                flowerElement.style.fontSize = '30px';
                flowerElement.style.cursor = 'move';
                
                // Add to canvas
                arrangementCanvas.appendChild(flowerElement);
                
                // Add to arrangement items
                arrangementItems.push({
                    element: flowerElement,
                    flower: selectedFlower,
                    x: x,
                    y: y
                });
                
                // Make draggable
                makeDraggable(flowerElement);
            }
        });
    }
    
    function makeDraggable(element) {
        let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        
        element.onmousedown = dragMouseDown;
        
        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            // get the mouse cursor position at startup:
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            // call a function whenever the cursor moves:
            document.onmousemove = elementDrag;
        }
        
        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            // calculate the new cursor position:
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            // set the element's new position:
            element.style.top = (element.offsetTop - pos2) + "px";
            element.style.left = (element.offsetLeft - pos1) + "px";
        }
        
        function closeDragElement() {
            // stop moving when mouse button is released:
            document.onmouseup = null;
            document.onmousemove = null;
        }
    }
    
    // Clear arrangement button
    const clearArrangementBtn = document.getElementById('clear-arrangement');
    if (clearArrangementBtn) {
        clearArrangementBtn.addEventListener('click', function() {
            if (arrangementCanvas) {
                arrangementCanvas.innerHTML = '';
                arrangementItems = [];
            }
        });
    }
    
    // Save arrangement button
    const saveArrangementBtn = document.getElementById('save-arrangement');
    if (saveArrangementBtn) {
        saveArrangementBtn.addEventListener('click', function() {
            if (arrangementItems.length > 0) {
                // Create a simple notification
                const notification = document.createElement('div');
                notification.className = 'arrangement-notification';
                notification.textContent = 'Arrangement saved successfully!';
                notification.style.backgroundColor = '#4CAF50';
                document.body.appendChild(notification);
                
                setTimeout(function() {
                    notification.remove();
                }, 3000);
            } else {
                // Create a simple notification
                const notification = document.createElement('div');
                notification.className = 'arrangement-notification';
                notification.textContent = 'Please create an arrangement first!';
                notification.style.backgroundColor = '#f44336';
                document.body.appendChild(notification);
                
                setTimeout(function() {
                    notification.remove();
                }, 3000);
            }
        });
    }
    
    // Order arrangement button
    const orderArrangementBtn = document.getElementById('order-arrangement');
    if (orderArrangementBtn) {
        orderArrangementBtn.addEventListener('click', function() {
            if (arrangementItems.length > 0) {
                // Create a simple modal or alert for ordering
                const modal = document.createElement('div');
                modal.className = 'order-modal';
                modal.innerHTML = `
                    <div class="modal-content">
                        <span class="close-modal">&times;</span>
                        <h3>Order Your Arrangement</h3>
                        <p>Please login or register to order your custom arrangement.</p>
                        <div class="modal-actions">
                            <a href="login.php" class="btn">Login</a>
                            <a href="register.php" class="btn">Register</a>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
                
                // Close modal when clicking on X
                modal.querySelector('.close-modal').addEventListener('click', function() {
                    modal.remove();
                });
                
                // Close modal when clicking outside
                window.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        modal.remove();
                    }
                });
            } else {
                // Create a simple notification
                const notification = document.createElement('div');
                notification.className = 'arrangement-notification';
                notification.textContent = 'Please create an arrangement first!';
                notification.style.backgroundColor = '#f44336';
                document.body.appendChild(notification);
                
                setTimeout(function() {
                    notification.remove();
                }, 3000);
            }
        });
    }
    
    // FAQ Accordion functionality
    const faqQuestions = document.querySelectorAll('.faq-question');
    
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const faqItem = this.parentElement;
            const answer = this.nextElementSibling;
            
            // Toggle active class
            faqItem.classList.toggle('active');
            
            // Toggle answer visibility
            if (faqItem.classList.contains('active')) {
                answer.style.maxHeight = answer.scrollHeight + "px";
            } else {
                answer.style.maxHeight = "0";
            }
        });
    });
    
    // Theme toggle functionality
    const themeBtn = document.getElementById('theme-btn');
    const body = document.body;
    
    // Check for saved theme preference or default to light
    const currentTheme = localStorage.getItem('theme') || 'light';
    
    if (currentTheme === 'dark') {
        body.setAttribute('data-theme', 'dark');
        themeBtn.innerHTML = '<i class="fas fa-sun"></i>';
    }
    
    themeBtn.addEventListener('click', function() {
        // Toggle theme
        if (body.getAttribute('data-theme') === 'dark') {
            body.removeAttribute('data-theme');
            themeBtn.innerHTML = '<i class="fas fa-moon"></i>';
            localStorage.setItem('theme', 'light');
        } else {
            body.setAttribute('data-theme', 'dark');
            themeBtn.innerHTML = '<i class="fas fa-sun"></i>';
            localStorage.setItem('theme', 'dark');
        }
    });
    
    // Live Chat functionality
    const chatButton = document.querySelector('.chat-button');
    const chatWindow = document.querySelector('.chat-window');
    const chatClose = document.querySelector('.chat-close');
    const chatSend = document.querySelector('.chat-send');
    const chatInput = document.querySelector('.chat-input');
    const chatMessages = document.querySelector('.chat-messages');
    
    if (chatButton) {
        chatButton.addEventListener('click', function() {
            chatWindow.classList.toggle('active');
        });
    }
    
    if (chatClose) {
        chatClose.addEventListener('click', function() {
            chatWindow.classList.remove('active');
        });
    }
    
    if (chatSend && chatInput && chatMessages) {
        chatSend.addEventListener('click', function() {
            sendMessage();
        });
        
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
        
        function sendMessage() {
            const message = chatInput.value.trim();
            if (message) {
                // Add user message
                const userMessage = document.createElement('div');
                userMessage.className = 'message user';
                userMessage.innerHTML = `<div class="message-content">${message}</div>`;
                chatMessages.appendChild(userMessage);
                
                // Clear input
                chatInput.value = '';
                
                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
                
                // Simulate bot response after a delay
                setTimeout(function() {
                    const botMessage = document.createElement('div');
                    botMessage.className = 'message bot';
                    botMessage.innerHTML = `<div class="message-content">Thank you for your message! Our team will get back to you soon.</div>`;
                    chatMessages.appendChild(botMessage);
                    
                    // Scroll to bottom
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 1000);
            }
        }
    }
    
    // Quick View functionality
    const quickViewButtons = document.querySelectorAll('.quick-view-btn');
    const quickViewModal = document.getElementById('quick-view-modal');
    const quickViewClose = document.querySelector('.quick-view-close');
    const quickViewBody = document.querySelector('.quick-view-body');
    
    quickViewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            
            // Show loading state
            quickViewBody.innerHTML = '<div class="loading">Loading product details...</div>';
            quickViewModal.classList.add('active');
            
            // Fetch product details via AJAX
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `get-product-details.php?id=${productId}`, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    quickViewBody.innerHTML = xhr.responseText;
                } else {
                    quickViewBody.innerHTML = '<div class="error">Failed to load product details.</div>';
                }
            };
            xhr.send();
        });
    });
    
    if (quickViewClose) {
        quickViewClose.addEventListener('click', function() {
            quickViewModal.classList.remove('active');
        });
    }
    
    // Close quick view modal when clicking outside
    window.addEventListener('click', function(event) {
        if (event.target === quickViewModal) {
            quickViewModal.classList.remove('active');
        }
    });
    
    // Progress bar animation
    const progressBars = document.querySelectorAll('.progress-fill');
    
    // Function to check if element is in viewport
    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }
    
    // Function to animate progress bars when in viewport
    function animateProgressBars() {
        progressBars.forEach(bar => {
            if (isInViewport(bar) && !bar.classList.contains('animated')) {
                const width = bar.getAttribute('data-width');
                bar.style.width = width + '%';
                bar.classList.add('animated');
            }
        });
    }
    
    // Check on scroll
    window.addEventListener('scroll', animateProgressBars);
    
    // Check on load
    animateProgressBars();
});