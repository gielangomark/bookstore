<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT USER & ADMIN
        User::create([
            'name' => 'Admin Toko',
            'email' => 'admin@tokobuku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Kantor Pusat Toko Buku',
        ]);

        User::create([
            'name' => 'Pelanggan Setia',
            'email' => 'user@tokobuku.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'phone' => '089876543210',
            'address' => 'Jl. Mawar No. 12, Jakarta Selatan',
        ]);

        // 2. BUAT KATEGORI
        $catFinance = Category::create(['name' => 'Finance & Investing']);
        $catSelfDev = Category::create(['name' => 'Self Development']);
        $catTech = Category::create(['name' => 'Technology']);
        $catNovel = Category::create(['name' => 'Novel & Sastra']);

        // 3. DAFTAR 20 BUKU (Dominan Finance)
        $books = [
            // --- KATEGORI FINANCE (12 Buku) ---
            [
                'title' => 'The Psychology of Money',
                'category_id' => $catFinance->id,
                'author' => 'Morgan Housel',
                'publisher' => 'Harriman House',
                'year' => 2020,
                'price' => 125000,
                'stock' => 50,
                'description' => 'Pelajaran abadi mengenai kekayaan, ketamakan, dan kebahagiaan. Buku ini membahas bagaimana perilaku kita terhadap uang lebih penting daripada kecerdasan kita.',
                'cover_image' => 'https://placehold.co/400x600/1e3a8a/FFF?text=Psychology+of+Money',
            ],
            [
                'title' => 'Rich Dad Poor Dad',
                'category_id' => $catFinance->id,
                'author' => 'Robert T. Kiyosaki',
                'publisher' => 'Plata Publishing',
                'year' => 1997,
                'price' => 95000,
                'stock' => 100,
                'description' => 'Buku keuangan pribadi #1 sepanjang masa. Mengajarkan perbedaan pola pikir orang kaya dan orang miskin tentang uang.',
                'cover_image' => 'https://placehold.co/400x600/4c1d95/FFF?text=Rich+Dad+Poor+Dad',
            ],
            [
                'title' => 'The Intelligent Investor',
                'category_id' => $catFinance->id,
                'author' => 'Benjamin Graham',
                'publisher' => 'Harper Business',
                'year' => 1949,
                'price' => 180000,
                'stock' => 30,
                'description' => 'Kitab suci bagi para investor saham. Mengajarkan konsep Value Investing yang digunakan oleh Warren Buffett.',
                'cover_image' => 'https://placehold.co/400x600/064e3b/FFF?text=Intelligent+Investor',
            ],
            [
                'title' => 'Think and Grow Rich',
                'category_id' => $catFinance->id,
                'author' => 'Napoleon Hill',
                'publisher' => 'The Ralston Society',
                'year' => 1937,
                'price' => 85000,
                'stock' => 60,
                'description' => 'Buku klasik tentang mindset sukses. Hasil riset 20 tahun terhadap orang-orang terkaya di dunia pada masanya.',
                'cover_image' => 'https://placehold.co/400x600/7c2d12/FFF?text=Think+Grow+Rich',
            ],
            [
                'title' => 'Cashflow Quadrant',
                'category_id' => $catFinance->id,
                'author' => 'Robert T. Kiyosaki',
                'publisher' => 'Plata Publishing',
                'year' => 2000,
                'price' => 110000,
                'stock' => 45,
                'description' => 'Panduan Ayah Kaya menuju kebebasan finansial. Membedakan antara Employee, Self-Employed, Business Owner, dan Investor.',
                'cover_image' => 'https://placehold.co/400x600/831843/FFF?text=Cashflow+Quadrant',
            ],
            [
                'title' => 'Money: Master the Game',
                'category_id' => $catFinance->id,
                'author' => 'Tony Robbins',
                'publisher' => 'Simon & Schuster',
                'year' => 2014,
                'price' => 250000,
                'stock' => 20,
                'description' => '7 Langkah sederhana menuju kebebasan finansial, dirangkum dari wawancara dengan 50 investor terhebat di dunia.',
                'cover_image' => 'https://placehold.co/400x600/14532d/FFF?text=Money+Master',
            ],
            [
                'title' => 'Secrets of the Millionaire Mind',
                'category_id' => $catFinance->id,
                'author' => 'T. Harv Eker',
                'publisher' => 'HarperCollins',
                'year' => 2005,
                'price' => 90000,
                'stock' => 55,
                'description' => 'Mengungkap "Money Blueprint" yang tertanam di alam bawah sadar kita dan bagaimana mengubahnya untuk sukses.',
                'cover_image' => 'https://placehold.co/400x600/eab308/000?text=Millionaire+Mind',
            ],
            [
                'title' => 'I Will Teach You to Be Rich',
                'category_id' => $catFinance->id,
                'author' => 'Ramit Sethi',
                'publisher' => 'Workman Publishing',
                'year' => 2009,
                'price' => 145000,
                'stock' => 40,
                'description' => 'Pendekatan modern terhadap uang tanpa harus berhemat minum kopi. Fokus pada big wins dan otomatisasi keuangan.',
                'cover_image' => 'https://placehold.co/400x600/2563eb/FFF?text=Teach+You+Rich',
            ],
            [
                'title' => 'Principles: Life and Work',
                'category_id' => $catFinance->id,
                'author' => 'Ray Dalio',
                'publisher' => 'Simon & Schuster',
                'year' => 2017,
                'price' => 300000,
                'stock' => 15,
                'description' => 'Prinsip-prinsip manajemen dan investasi dari pendiri Bridgewater Associates, hedge fund terbesar di dunia.',
                'cover_image' => 'https://placehold.co/400x600/000000/FFF?text=Principles',
            ],
            [
                'title' => 'One Up On Wall Street',
                'category_id' => $catFinance->id,
                'author' => 'Peter Lynch',
                'publisher' => 'Simon & Schuster',
                'year' => 1989,
                'price' => 135000,
                'stock' => 35,
                'description' => 'Bagaimana menggunakan apa yang sudah Anda ketahui untuk menghasilkan uang di pasar saham.',
                'cover_image' => 'https://placehold.co/400x600/0f766e/FFF?text=One+Up+WallSt',
            ],
            [
                'title' => 'The Alchemy of Finance',
                'category_id' => $catFinance->id,
                'author' => 'George Soros',
                'publisher' => 'Wiley',
                'year' => 1987,
                'price' => 210000,
                'stock' => 10,
                'description' => 'Membaca pikiran pasar melalui teori refleksivitas dari salah satu spekulan mata uang terbesar.',
                'cover_image' => 'https://placehold.co/400x600/4338ca/FFF?text=Alchemy+Finance',
            ],
            [
                'title' => 'Financial Freedom',
                'category_id' => $catFinance->id,
                'author' => 'Grant Sabatier',
                'publisher' => 'Penguin',
                'year' => 2019,
                'price' => 160000,
                'stock' => 25,
                'description' => 'Jalur cepat untuk mengumpulkan uang dan pensiun dini (FIRE Movement).',
                'cover_image' => 'https://placehold.co/400x600/be123c/FFF?text=Financial+Freedom',
            ],

            // --- KATEGORI SELF DEVELOPMENT (3 Buku) ---
            [
                'title' => 'Atomic Habits',
                'category_id' => $catSelfDev->id,
                'author' => 'James Clear',
                'publisher' => 'Penguin Random House',
                'year' => 2018,
                'price' => 108000,
                'stock' => 200,
                'description' => 'Perubahan kecil yang memberikan hasil luar biasa. Cara mudah membangun kebiasaan baik.',
                'cover_image' => 'https://placehold.co/400x600/d97706/FFF?text=Atomic+Habits',
            ],
            [
                'title' => 'Filosofi Teras',
                'category_id' => $catSelfDev->id,
                'author' => 'Henry Manampiring',
                'publisher' => 'Kompas',
                'year' => 2018,
                'price' => 98000,
                'stock' => 80,
                'description' => 'Penerapan filsafat Stoa dalam kehidupan sehari-hari untuk mental yang tangguh dan tenang.',
                'cover_image' => 'https://placehold.co/400x600/57534e/FFF?text=Filosofi+Teras',
            ],
            [
                'title' => 'The 7 Habits of Highly Effective People',
                'category_id' => $catSelfDev->id,
                'author' => 'Stephen Covey',
                'publisher' => 'Free Press',
                'year' => 1989,
                'price' => 115000,
                'stock' => 50,
                'description' => 'Pelajaran dahsyat dalam perubahan kepribadian agar menjadi manusia yang efektif.',
                'cover_image' => 'https://placehold.co/400x600/0ea5e9/FFF?text=7+Habits',
            ],

            // --- KATEGORI TECH (3 Buku) ---
            [
                'title' => 'Clean Code',
                'category_id' => $catTech->id,
                'author' => 'Robert C. Martin',
                'publisher' => 'Prentice Hall',
                'year' => 2008,
                'price' => 450000,
                'stock' => 20,
                'description' => 'Panduan menulis kode yang rapi, mudah dibaca, dan mudah dipelihara untuk programmer profesional.',
                'cover_image' => 'https://placehold.co/400x600/3f3f46/FFF?text=Clean+Code',
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'category_id' => $catTech->id,
                'author' => 'Andrew Hunt & David Thomas',
                'publisher' => 'Addison-Wesley',
                'year' => 1999,
                'price' => 500000,
                'stock' => 15,
                'description' => 'Perjalanan dari sekadar journeyman menjadi master dalam dunia software engineering.',
                'cover_image' => 'https://placehold.co/400x600/b91c1c/FFF?text=Pragmatic+Prog',
            ],
            [
                'title' => 'Mastering Laravel 11',
                'category_id' => $catTech->id,
                'author' => 'Taylor Otwell',
                'publisher' => 'Laravel LLC',
                'year' => 2024,
                'price' => 350000,
                'stock' => 100,
                'description' => 'Buku panduan lengkap untuk menguasai framework PHP terpopuler saat ini.',
                'cover_image' => 'https://placehold.co/400x600/ef4444/FFF?text=Mastering+Laravel',
            ],

            // --- KATEGORI NOVEL (2 Buku) ---
            [
                'title' => 'Laut Bercerita',
                'category_id' => $catNovel->id,
                'author' => 'Leila S. Chudori',
                'publisher' => 'KPG',
                'year' => 2017,
                'price' => 100000,
                'stock' => 60,
                'description' => 'Novel sejarah yang mengangkat kisah persahabatan, cinta, dan pengkhianatan di masa reformasi.',
                'cover_image' => 'https://placehold.co/400x600/1e40af/FFF?text=Laut+Bercerita',
            ],
            [
                'title' => 'Bumi Manusia',
                'category_id' => $catNovel->id,
                'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Lentera Dipantara',
                'year' => 1980,
                'price' => 135000,
                'stock' => 40,
                'description' => 'Kisah Minke, seorang pribumi di zaman kolonial yang menolak tunduk pada ketidakadilan.',
                'cover_image' => 'https://placehold.co/400x600/854d0e/FFF?text=Bumi+Manusia',
            ],
        ];

        // 4. EKSEKUSI LOOPING
        foreach ($books as $book) {
            Book::create($book);
        }
    }
}