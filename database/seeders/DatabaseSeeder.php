<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'phone' => '081118881238',
            'password' => Hash::make('admin'),
            'description' => 'admin 1',
            'active' => '1',
            'function' => 'Public Relation'
        ]);
        
        \App\Models\User::factory()->create([
            'active' => '1',
            'name' => 'user',
            'email' => 'user@user.com',
            'role' => 'user',
            'phone' => '081118881230',
            'password' => Hash::make('user'),
            'description' => 'user magang',
            'function' => 'Marketing',
        ]);
        
        \App\Models\User::factory()->create([
            'active' => '0',
            'name' => 'user',
            'email' => 'user0@user.com',
            'role' => 'user',
            'phone' => '081118881232',
            'password' => Hash::make('user'),
            'description' => 'user magang lama',
            'function' => 'Marketing',
        ]);

        \App\Models\Category::factory()->create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized'
        ]);
        
        \App\Models\Category::factory()->create([
            'name' => 'Rekomendasi Kampus',
            'slug' => 'rekomendasi-kampus'
        ]);
        
        \App\Models\Category::factory()->create([
            'name' => 'Informasi Kota',
            'slug' => 'informasi-kota'
        ]);
        
        \App\Models\Category::factory()->create([
            'name' => 'Testing',
            'slug' => 'testing'
        ]);

        \App\Models\Post::factory(10)->create();
        \App\Models\Post::factory(1)->create([
            'status' => 'draft'
        ]);
        
        // \App\Models\Post::factory()->create([
        //     'category_id' => 1,
        //     'acc_by' => 1,
        //     'title' => 'Rekomendasi Kampus Jurusan Teknik Kimia di Turki',
        //     'slug' => 'Rekomendasi-Kampus-Jurusan-Teknik-Kimia-di-Turki',
        //     'status' => 'published',
        //     'description' => '-',
        //     'revision_note' => '-',
        //     'post' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim vero laborum odio quibusdam, incidunt dolorem quod similique numquam itaque officiis? Laboriosam fugiat hic optio cupiditate asperiores neque cumque rerum soluta numquam! Minima recusandae placeat iste voluptate mollitia rerum quibusdam voluptatem dolorem vitae consequatur, laboriosam distinctio sit nostrum aspernatur sunt laudantium!
        //     Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim vero laborum odio quibusdam, incidunt dolorem quod similique numquam itaque officiis? Laboriosam fugiat hic optio cupiditate asperiores neque cumque rerum soluta numquam! Minima recusandae placeat iste voluptate mollitia rerum quibusdam voluptatem dolorem vitae consequatur, laboriosam distinctio sit nostrum aspernatur sunt laudantium!
        //     Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim vero laborum odio quibusdam, incidunt dolorem quod similique numquam itaque officiis? Laboriosam fugiat hic optio cupiditate asperiores neque cumque rerum soluta numquam! Minima recusandae placeat iste voluptate mollitia rerum quibusdam voluptatem dolorem vitae consequatur, laboriosam distinctio sit nostrum aspernatur sunt laudantium!
        //     Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim vero laborum odio quibusdam, incidunt dolorem quod similique numquam itaque officiis? Laboriosam fugiat hic optio cupiditate asperiores neque cumque rerum soluta numquam! Minima recusandae placeat iste voluptate mollitia rerum quibusdam voluptatem dolorem vitae consequatur, laboriosam distinctio sit nostrum aspernatur sunt laudantium!',
        // ]);
        
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 1]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [1, 2]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 3]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 4]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 5]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 6]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 7]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 8]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 9]);
        DB::insert('insert into writers (user_id, post_id) values (?, ?)', [2, 10]);
    }
}
