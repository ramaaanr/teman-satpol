<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('admin');

        $users = [
            ['nama' => 'HIDAYATURAHMAN ,S.Sos, M.Si', 'NIP' => '197008151990031002', 'jabatan' => 'KEPALA SATPOL PP', 'role' => 'super admin', 'password' => $password],
            ['nama' => 'MUHAMMAD DJUNAIDI ,SE', 'NIP' => '197202122006041018', 'jabatan' => 'SEKRETARIS', 'role' => 'giat admin', 'password' => $password],
            ['nama' => 'WATERLAND WIND FIRE ,AP, MM', 'NIP' => '197601231994121002', 'jabatan' => 'POL PP MADYA', 'role' => 'giat admin', 'password' => $password],
            ['nama' => 'H. DENNY MAHENDRATA ,SH, MH', 'NIP' => '196911081998031006', 'jabatan' => 'KEPALA BIDANG PENEGAKAN PER UU DAERAH', 'role' => 'giat admin', 'password' => $password],
            ['nama' => 'TAMSIN ,S.Hut, MM', 'NIP' => '197411062008011007', 'jabatan' => 'KEPALA BIDANG SUMBER DAYA APARATUR', 'role' => 'giat admin', 'password' => $password],
            ['nama' => 'DJOHANSYAH ,S.Hut', 'NIP' => '197107242006041009', 'jabatan' => 'KEPALA BIDANG KETERTIBAN UMUM DAN KETENTRAMAN MASYARAKAT', 'role' => 'approval', 'password' => $password],
            ['nama' => 'INDERA HERMAWAN P ,S.Sos', 'NIP' => '197410062007011011', 'jabatan' => 'KEPALA BIDANG PERLINDUNGAN MASYARAKAT', 'role' => 'approval', 'password' => $password],
            ['nama' => 'SYAFRULLAH ,S.Sos, M.Si', 'NIP' => '197912242009011001', 'jabatan' => 'KEPALA UPT PEMADAM KEBAKARAN', 'role' => 'approval', 'password' => $password],
            ['nama' => 'UMI SALAMAH ,SE', 'NIP' => '197101121990032003', 'jabatan' => 'KEPALA SUB BAGIAN KEUANGAN', 'role' => 'approval', 'password' => $password],
            ['nama' => 'HAIRUNNISA HALIM ,S.Ag', 'NIP' => '197307042008012016', 'jabatan' => 'KEPALA SEKSI TEKNIS FUNGSIONAL', 'role' => 'approval', 'password' => $password],
        ];

        $staff = [
            ['nama' => 'SYAKIR ,SH', 'NIP' => '197801212010011006', 'jabatan' => 'KEPALA SEKSI PENYELIDIKAN DAN PENYIDIKAN'],
            ['nama' => 'SYAFRUDIN PRAWIRA BUANA ,SE', 'NIP' => '197509242010011001', 'jabatan' => 'KEPALA SEKSI PEMBINAAN, PENGAWASAN DAN PENYULUHAN'],
            ['nama' => 'H. MUHAMMAD SYAHRI FADHLI ,S.Kom', 'NIP' => '198412152008031001', 'jabatan' => 'KEPALA SEKSI PELATIHAN DASAR'],
            ['nama' => 'SYAMSIAR PANANI ,SE', 'NIP' => '197309112006041011', 'jabatan' => 'POL PP MUDA'],
            ['nama' => 'MUHAMMAD RUSLIE ,SE', 'NIP' => '197109062006041017', 'jabatan' => 'POL PP MUDA'],
            ['nama' => 'DOONI KUSWORO ,SE', 'NIP' => '197802222007011008', 'jabatan' => 'POL PP MUDA'],
            ['nama' => 'A KASWARI ,SE,MM', 'NIP' => '197602112007011012', 'jabatan' => 'KEPALA SEKSI PERLINDUNGAN MASYARAKAT'],
            ['nama' => 'RINI ARIESANTI ,SE', 'NIP' => '197903242007012010', 'jabatan' => 'KEPALA SUB BAGIAN PERENCANAAN'],
            ['nama' => 'YANTO HIDAYAT ,SE', 'NIP' => '197108132006041016', 'jabatan' => 'KEPALA SEKSI OPERASI DAN PENGENDALIAN'],
            ['nama' => 'SYARIYADI ,SE', 'NIP' => '197501022006041018', 'jabatan' => 'KEPALA SEKSI KERJASAMA'],
        ];

        foreach ($staff as &$user) {
            $user['role'] = 'staff';
            $user['password'] = $password;
        }

        DB::table('users')->insert(array_merge($users, $staff));
    }
}