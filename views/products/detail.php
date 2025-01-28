<div class="row">
    <div class="col-md-6">
        <div class="product-gallery">
            <div class="main-image mb-3">
                <img src="<?php echo htmlspecialchars($product['main_image']); ?>" 
                     class="img-fluid" 
                     alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="thumbnail-images">
                <img src="<?php echo htmlspecialchars($product['main_image']); ?>" 
                     class="img-thumbnail" 
                     alt="<?php echo htmlspecialchars($product['name']); ?>">
                <?php foreach ($productImages as $image): ?>
                    <img src="<?php echo htmlspecialchars($image['url']); ?>" 
                         class="img-thumbnail" 
                         alt="<?php echo htmlspecialchars($product['name']); ?>">
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p class="price h2 my-4">$<?php echo number_format($product['price'], 2); ?></p>
        <div class="description mb-4">
            <?php echo nl2br(htmlspecialchars($product['description'])); ?>
        </div>
        
        <form action="/order" method="GET" class="mb-4">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
            <div class="form-group mb-3">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
            </div>
            <button type="submit" class="btn btn-primary">Order Now</button>
        </form>
    </div>
</div>