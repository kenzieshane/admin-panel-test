<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Book;
use App\Models\Member;
use App\Services\QrCodeService;
use Illuminate\Database\Seeder;
class LibrarySeeder extends Seeder
{
public function run(QrCodeService $qrCodeService): void
{
// Buat kategori
$categories = [
['name' => 'Fiksi', 'description' => 'Novel dan cerita fiksi', 'color' => '#3B82F6'],
['name' => 'Non-Fiksi', 'description' => 'Buku berdasarkan fakta', 'color' => '#10B981'],
['name' => 'Sains', 'description' => 'Buku ilmu pengetahuan', 'color' => '#8B5CF6'],
['name' => 'Sejarah', 'description' => 'Buku sejarah', 'color' => '#F59E0B'],
['name' => 'Teknologi', 'description' => 'Buku teknologi dan komputer', 'color' => '#EF4444'],
];
    foreach ($categories as $category) {
        Category::create($category);
    }

    // Buat buku dummy
    $books = [
        [
            'isbn' => '978-0-123456-78-9',
            'title' => 'Belajar Laravel untuk Pemula',
            'author' => 'John Doe',
            'publisher' => 'Tech Publisher',
            'publication_year' => 2024,
            'category_id' => 5,
            'description' => 'Panduan lengkap belajar Laravel dari nol',
            'total_copies' => 5,
            'available_copies' => 5,
            'location' => 'A-01-01',
        ],
        [
            'isbn' => '978-0-123456-79-6',
            'title' => 'Database Design Best Practices',
            'author' => 'Jane Smith',
            'publisher' => 'Data Press',
            'publication_year' => 2023,
            'category_id' => 5,
            'description' => 'Cara merancang database yang efisien',
            'total_copies' => 3,
            'available_copies' => 3,
            'location' => 'A-01-02',
        ],
        // Tambahkan lebih banyak buku sesuai kebutuhan
    ];

    foreach ($books as $book) {
        Book::create($book);
    }

    // Buat member dummy
    $members = [
        [
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@example.com',
            'phone' => '081234567890',
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'date_of_birth' => '2000-05-15',
            'gender' => 'male',
            'membership_start' => now(),
            'membership_end' => now()->addYear(),
            'status' => 'active',
        ],
        [
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'phone' => '081234567891',
            'address' => 'Jl. Sudirman No. 456, Jakarta',
            'date_of_birth' => '1998-08-20',
            'gender' => 'female',
            'membership_start' => now(),
            'membership_end' => now()->addYear(),
            'status' => 'active',
        ],
    ];

    foreach ($members as $memberData) {
        $member = Member::create($memberData);
        
        // Generate QR Code untuk setiap member
        $qrCodeService->generateForMember($member);
    }

    $this->command->info('Library data seeded successfully!');
}


}
