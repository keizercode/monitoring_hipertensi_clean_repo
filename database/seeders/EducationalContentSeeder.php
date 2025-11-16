<?php

namespace Database\Seeders;

use App\Models\EducationalContent;
use Illuminate\Database\Seeder;

class EducationalContentSeeder extends Seeder
{
    public function run()
    {
        $contents = [
            // Diet Rendah Garam
            [
                'title' => 'Panduan Diet Rendah Garam',
                'category' => 'diet',
                'content' => 'Batasi konsumsi garam maksimal 5 gram (1 sendok teh) per hari. Hindari makanan olahan, makanan kaleng, dan makanan cepat saji. Gunakan rempah-rempah sebagai pengganti garam.',
                'icon' => 'utensils'
            ],
            [
                'title' => 'Makanan yang Harus Dihindari',
                'category' => 'diet',
                'content' => 'Hindari: makanan kaleng, keripik, saus kemasan, daging olahan (sosis, nugget, kornet), makanan cepat saji, keju, dan acar.',
                'icon' => 'ban'
            ],
            [
                'title' => 'Makanan yang Dianjurkan',
                'category' => 'diet',
                'content' => 'Konsumsi: buah dan sayur segar, gandum utuh, ikan, ayam tanpa kulit, kacang-kacangan, dan produk susu rendah lemak.',
                'icon' => 'apple-alt' // diperbaiki
            ],

            // Olahraga
            [
                'title' => 'Olahraga Teratur',
                'category' => 'exercise',
                'content' => 'Lakukan aktivitas fisik minimal 30 menit sehari, 5 hari dalam seminggu. Pilih olahraga yang Anda sukai seperti jalan cepat, bersepeda, atau berenang.',
                'icon' => 'dumbbell'
            ],
            [
                'title' => 'Jalan Kaki',
                'category' => 'exercise',
                'content' => 'Jalan kaki 10.000 langkah per hari dapat membantu menurunkan tekanan darah. Gunakan tangga daripada lift, parkir lebih jauh dari tujuan.',
                'icon' => 'walking'
            ],

            // Hidrasi
            [
                'title' => 'Minum Air yang Cukup',
                'category' => 'hydration',
                'content' => 'Minum air putih 8 gelas (2 liter) per hari. Air membantu melancarkan peredaran darah dan menjaga keseimbangan cairan tubuh.',
                'icon' => 'tint' // diperbaiki
            ],
            [
                'title' => 'Hindari Minuman Berkafein Berlebihan',
                'category' => 'hydration',
                'content' => 'Batasi konsumsi kopi, teh, dan minuman bersoda. Kafein dapat meningkatkan tekanan darah sementara.',
                'icon' => 'coffee'
            ],

            // Obat
            [
                'title' => 'Minum Obat Teratur',
                'category' => 'medication',
                'content' => 'Konsumsi obat sesuai anjuran dokter. Jangan menghentikan obat tanpa konsultasi. Gunakan pengingat untuk memastikan tidak lupa minum obat.',
                'icon' => 'pills'
            ],
            [
                'title' => 'Efek Samping Obat',
                'category' => 'medication',
                'content' => 'Jika mengalami efek samping seperti pusing, mual, atau batuk kering, segera konsultasikan dengan dokter. Jangan mengubah dosis sendiri.',
                'icon' => 'stethoscope'
            ],
        ];

        foreach ($contents as $content) {
            EducationalContent::create($content);
        }
    }
}
