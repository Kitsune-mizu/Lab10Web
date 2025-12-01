<?php
$db = $GLOBALS['db'];

// Query untuk mengambil data barang menggunakan Database class
$barang_list = $db->getAll('data_barang', null, 'id_barang ASC');
?>

<div class="page-header">
    <div class="header-title">
        <h2><i class="fas fa-boxes"></i> Data Barang</h2>
        <p>Kelola data barang dalam sistem inventory</p>
    </div>
    <a href="<?php echo BASE_URL; ?>/barang/add" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Tambah Barang
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if (count($barang_list) > 0): ?>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($barang_list as $row): ?>
                            <tr>
                                <td><?php echo $row['id_barang']; ?></td>
                                <td class="product-image">
                                    <?php 
                                    $imagePath = GAMBAR_PATH . '/' . $row['gambar'];
                                    $imageUrl = $row['gambar'] ? GAMBAR_URL . '/' . $row['gambar'] : '';
                                    
                                    if (!empty($row['gambar']) && file_exists($imagePath)): 
                                    ?>
                                        <img src="<?php echo $imageUrl; ?>" 
                                             alt="<?php echo htmlspecialchars($row['nama']); ?>" 
                                             style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                                    <?php else: ?>
                                        <div class="no-image" style="width: 60px; height: 60px; background: #f7fafc; border: 2px dashed #cbd5e0; border-radius: 5px; display: flex; align-items: center; justify-content: center; color: #a0aec0;">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="product-name"><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td class="product-category">
                                    <span class="category-badge"><?php echo htmlspecialchars($row['kategori']); ?></span>
                                </td>
                                <td class="product-price">Rp <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
                                <td class="product-price">Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
                                <td class="product-stock">
                                    <span class="stock-badge <?php echo $row['stok'] > 0 ? 'in-stock' : 'out-of-stock'; ?>">
                                        <?php echo $row['stok']; ?>
                                    </span>
                                </td>
                                <td class="action-buttons">
                                    <a href="<?php echo BASE_URL; ?>/barang/edit/<?php echo $row['id_barang']; ?>" 
                                       class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>/barang/delete/<?php echo $row['id_barang']; ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirmDelete()" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h3>Belum ada data barang</h3>
                <p>Silakan tambah barang baru untuk memulai</p>
                <a href="<?php echo BASE_URL; ?>/barang/add" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Tambah Barang Pertama
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>