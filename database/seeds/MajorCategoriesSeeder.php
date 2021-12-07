<?php
// 親カテゴリのシーダー。

use Illuminate\Database\Seeder;
use App\MajorCategory; //追加

class MajorCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $major_category_names = [
            '本', 'コンピュータ', 'ディスプレイ'
        ];
        
        foreach ($major_category_names as $major_category_name) {
            MajorCategory::create([
                'name' => $major_category_name,
                'description' => $major_category_name,
        ]);
        }
    }
}
