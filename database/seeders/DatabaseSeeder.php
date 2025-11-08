<?php  
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate([
            'name' => 'Admin MatraMent',
            'email' => 'admin@matrament.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
        ]);

        // Create Sample Customer
        User::updateOrCreate([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
            'phone' => '081234567891',
            'address' => 'Jl. Customer No. 2, Jakarta',
        ]);

        // Create Categories
        $categories = [
            [
                'name' => 'Kaos',
                'slug' => 'kaos',
                'description' => 'Koleksi kaos thrift berkualitas',
            ],
            [
                'name' => 'Jaket',
                'slug' => 'jaket',
                'description' => 'Jaket vintage dan modern',
            ],
            [
                'name' => 'Celana',
                'slug' => 'celana',
                'description' => 'Celana jeans dan chinos',
            ],
            [
                'name' => 'Hoodie',
                'slug' => 'hoodie',
                'description' => 'Hoodie nyaman untuk santai',
            ],
            [
                'name' => 'Aksesoris',
                'slug' => 'aksesoris',
                'description' => 'Tas, topi, dan aksesoris lainnya',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Sample Products
        $products = [
            [
                'category_id' => 1,
                'name' => 'Vintage Band T-Shirt',
                'description' => 'Kaos band vintage dari tahun 90an dengan kondisi sangat baik. Bahan katun premium yang nyaman dipakai.',
                'price' => 75000,
                'stock' => 5,
                'size' => 'M, L',
                'condition' => 'Baik',
                'is_featured' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Plain White Tee',
                'description' => 'Kaos putih polos berkualitas tinggi, cocok untuk daily wear.',
                'price' => 45000,
                'stock' => 10,
                'size' => 'S, M, L, XL',
                'condition' => 'Seperti Baru',
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Denim Jacket',
                'description' => 'Jaket denim klasik yang tidak pernah ketinggalan zaman.',
                'price' => 150000,
                'stock' => 3,
                'size' => 'M, L',
                'condition' => 'Baik',
                'is_featured' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Bomber Jacket',
                'description' => 'Bomber jacket dengan design modern dan warna hitam elegan.',
                'price' => 120000,
                'stock' => 4,
                'size' => 'L, XL',
                'condition' => 'Seperti Baru',
                'is_featured' => false,
            ],
            [
                'category_id' => 3,
                'name' => 'Levi\'s 501 Jeans',
                'description' => 'Celana jeans Levi\'s 501 original dengan kondisi prima.',
                'price' => 200000,
                'stock' => 2,
                'size' => '30, 32, 34',
                'condition' => 'Baik',
                'is_featured' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Chino Pants',
                'description' => 'Celana chino warna khaki, sempurna untuk casual dan formal.',
                'price' => 85000,
                'stock' => 6,
                'size' => '30, 32',
                'condition' => 'Seperti Baru',
                'is_featured' => false,
            ],
            [
                'category_id' => 4,
                'name' => 'Champion Hoodie',
                'description' => 'Hoodie Champion original dengan logo klasik.',
                'price' => 180000,
                'stock' => 3,
                'size' => 'M, L',
                'condition' => 'Baik',
                'is_featured' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Zip-Up Hoodie',
                'description' => 'Hoodie dengan zipper depan, praktis dan stylish.',
                'price' => 95000,
                'stock' => 5,
                'size' => 'L, XL',
                'condition' => 'Seperti Baru',
                'is_featured' => false,
            ],
            [
                'category_id' => 5,
                'name' => 'Vintage Backpack',
                'description' => 'Tas ransel vintage dengan banyak kompartemen.',
                'price' => 120000,
                'stock' => 4,
                'size' => 'One Size',
                'condition' => 'Baik',
                'is_featured' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Baseball Cap',
                'description' => 'Topi baseball dengan berbagai warna pilihan.',
                'price' => 35000,
                'stock' => 15,
                'size' => 'One Size',
                'condition' => 'Seperti Baru',
                'is_featured' => false,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: admin@matrament.com / password123');
        $this->command->info('Customer Login: customer@test.com / password123');
    }
}