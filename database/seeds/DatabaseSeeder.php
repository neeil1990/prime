<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SettingField::class);
    }
}


class SettingField extends Seeder
{

    public function run(){


        \DB::table('setting_fields')->delete();

        \App\SettingField::create([
           'name' => 'Имя проекта',
           'field' => 'name_progect_seo',
           'value' => '1',
           'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Бюджет',
            'field' => 'budjet_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Освоено',
            'field' => 'osvoeno_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Освоено %',
            'field' => 'osvoeno_procent_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Специалист',
            'field' => 'specialist_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => '% от проекта',
            'field' => 'procent_ot_project_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Сумма на з.п.',
            'field' => 'summa_na_zp_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Стартпоинт',
            'field' => 'startpoint_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'LP',
            'field' => 'LP_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Старт',
            'field' => 'start_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Конец',
            'field' => 'end_seo',
            'value' => '1',
            'table_value' => 'seo'

        ]);

        \App\SettingField::create([
            'name' => 'Остаток дней',
            'field' => 'ostatok_day_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Цель',
            'field' => 'aim_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Регион',
            'field' => 'region_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Номер договора',
            'field' => 'number_dogovor_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Контактное лицо',
            'field' => 'contact_persone_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Номер телефона',
            'field' => 'number_phone_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'e-mail',
            'field' => 'mail_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);

        \App\SettingField::create([
            'name' => 'Дополнительная информация',
            'field' => 'dop_infa_seo',
            'value' => '1',
            'table_value' => 'seo'
        ]);


        //context


        \App\SettingField::create([
            'name' => 'Имя проекта',
            'field' => 'name_progect_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Я.Директ',
            'field' => 'yandex_direct_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Г.Адвордс',
            'field' => 'google_advords_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Остаток на балансе Яндекса',
            'field' => 'ostatok_na_yandex_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Остаток на балансе Гугл',
            'field' => 'ostatok_na_google_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Специалист',
            'field' => 'specialist_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => '% от проекта',
            'field' => 'procent_ot_project_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Сумма на з.п.',
            'field' => 'summ_na_zp_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Номер договора',
            'field' => 'number_dog_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Контактное лицо',
            'field' => 'contact_persone_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Номер телефона',
            'field' => 'number_phone_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'e-mail',
            'field' => 'mail_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

        \App\SettingField::create([
            'name' => 'Дополнительная информация',
            'field' => 'dop_infa_context',
            'value' => '1',
            'table_value' => 'context'
        ]);

    }


}
