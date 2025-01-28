<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Our Products</h1>
    </div>

    <?php if (!empty($products)): ?>
        <?php foreach ($products as $product): ?>
            <!---test version --->
            <div class="col-md-4 mb-4">
                <div class="card product-card">
                    <div class="product-images-slider position-relative">
                        <div class="image-container">
                            <!-- Display the main image first -->
                            <img src="<?php echo htmlspecialchars($product['main_image']); ?>" 
                                class="card-img-top" 
                                alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                data-index="0">
                            <!-- Display additional images -->
                            <?php foreach ($product['images'] as $index => $image): ?>
                                <img src="<?php echo htmlspecialchars($image); ?>" 
                                    class="card-img-top <?php echo $index === 0 ? 'd-none' : ''; ?>" 
                                    alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                    data-index="<?php echo $index + 1; ?>"> <!-- Adjust index for additional images -->
                            <?php endforeach; ?>
                        </div>
                        <button class="btn btn-secondary left-arrow position-absolute" style="left: 10px; top: 50%; transform: translateY(-50%);">❮</button>
                        <button class="btn btn-secondary right-arrow position-absolute" style="right: 10px; top: 50%; transform: translateY(-50%);">❯</button>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($product['short_description']); ?></p>
                        <p class="card-text"><strong>$<?php echo number_format($product['price'], 2); ?></strong></p>
                        <a href="/product?id=<?php echo $product['id']; ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            <!---end test version --->
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found.</p>
    <?php endif; ?>
</div>

<!-- Pagination -->
<?php if ($totalPages > 1): ?>
<nav aria-label="Product pagination">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?php echo $currentPage == $i ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<?php endif; ?>