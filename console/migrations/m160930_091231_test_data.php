<?php

use yii\db\Migration;

class m160930_091231_test_data extends Migration
{
    public function up()
    {
        $this->insert('companies', [
            'title' => 'Winner',
            'description' => 'Winner company description',
            'bg_color' => '#000',
            'logo' => '/uploads/bet365.png',
            'site_url' => 'http://winner.com',
            'address' => 'winner address',
            'created_at' => 1471212,
            'updated_at' => 3214234,
            'rating' => 10,
            'director_id' => 1
        ]);

        $this->insert('directors', [
            'title' => 'Winner Director',
            'description' => 'Winner director description',
            'photo' => 'manpic.jpg'
        ]);

        $this->insert('licenses', [
            'title' => 'Licence 1',
            'file_label' => 'License 1',
            'url' => 'file.docx'
        ]);

        $this->insert('licenses', [
            'title' => 'Licence 2',
            'file_label' => 'License 2',
            'url' => 'file.docx'
        ]);

        $this->insert('licenses', [
            'title' => 'Licence 1',
            'file_label' => 'License 1',
            'url' => 'file.docx'
        ]);

        $this->insert('categories', [
            'title' => 'Casino'
        ]);
        $this->insert('categories', [
            'title' => 'Poker'
        ]);

        $this->insert('reviews', [
            'title' => 'Winner Casino',
            'description' => 'Winner Casino review',
            'preview' => 'screen-1.jpg',
            'address' => 'Winner Casino address',
            'category_id' => 1
        ]);

        $this->insert('reviews', [
            'title' => 'Winner Poker',
            'description' => 'Winner Poker review',
            'preview' => 'screen-1.jpg',
            'address' => 'Winner Poker address',
            'category_id' => 2
        ]);

        $this->insert('bonuses', [
            'title' => 'Sing up bonus 1',
            'description' => 'Sing up bonus 1 description',
            'logo' => '/uploads/bet365-poker.jpg',
            'price' => 30,
            'code' => 'CODE1',
            'min_deposit' => 10,
            'referal_url' => 'http://bonus1.referal',
            'expiry' => 12,
            'rollover_requirement' => 'sadfjqdwjkqw',
            'restrictions' => 'asdnqwofhiuqwed'
        ]);
    }

    public function down()
    {
        echo "m160930_091231_test_data cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
