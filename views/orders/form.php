<div class="row">
    <div class="col-md-8 mx-auto">
        <h2 class="mb-4">Order Details</h2>
        
        <!-- Product Summary -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <div class="row">
                    <div class="col-md-3">
                        <img src="<?php echo htmlspecialchars($product['main_image']); ?>" 
                             class="img-fluid" 
                             alt="<?php echo htmlspecialchars($product['name']); ?>">
                    </div>
                    <div class="col-md-9">
                        <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                        <p>Quantity: <?php echo intval($quantity); ?></p>
                        <p>Price per item: $<?php echo number_format($product['price'], 2); ?></p>
                        <p class="h5">Total: $<?php echo number_format($product['price'] * $quantity, 2); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Form -->
        <form action="/order/submit" method="POST" id="orderForm">
            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            
            <div class="mb-3">
                <label for="customer_name" class="form-label">Full Name *</label>
                <input type="text" class="form-control <?php echo isset($errors['customer_name']) ? 'is-invalid' : ''; ?>" 
                       id="customer_name" name="customer_name" required>
                <?php if (isset($errors['customer_name'])): ?>
                <div class="invalid-feedback"><?php echo $errors['customer_name']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number *</label>
                <input type="tel" class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>" 
                       id="phone" name="phone" required>
                <?php if (isset($errors['phone'])): ?>
                <div class="invalid-feedback"><?php echo $errors['phone']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="address" class="form-label">Delivery Address *</label>
                <textarea class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>" 
                          id="address" name="address" rows="3" required></textarea>
                <?php if (isset($errors['address'])): ?>
                <div class="invalid-feedback"><?php echo $errors['address']; ?></div>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn btn-primary">Confirm Order</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    // Phone number validation
    $('#phone').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    // Form validation
    $('#orderForm').submit(function(e) {
        let isValid = true;
        
        // Reset previous validation states
        $('.is-invalid').removeClass('is-invalid');
        
        // Validate name
        if ($('#customer_name').val().trim() === '') {
            $('#customer_name').addClass('is-invalid');
            isValid = false;
        }
        
        // Validate phone
        if (!$('#phone').val().match(/^[0-9]{10}$/)) {
            $('#phone').addClass('is-invalid');
            isValid = false;
        }
        
        // Validate address
        if ($('#address').val().trim() === '') {
            $('#address').addClass('is-invalid');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
});
</script>
