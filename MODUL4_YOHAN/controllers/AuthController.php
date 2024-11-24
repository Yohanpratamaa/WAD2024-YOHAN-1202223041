<?php

class AuthController
{
    private $conn;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        require_once 'config/database.php';
        $this->conn = $conn;
    }

    public function login()
    {
        $conn = $this->conn;
        if (isset($_POST['submit'])) {

            // TODO: Lengkapi fungsi login dengan langkah berikut:
            // 1. Ambil nim dari form login menggunakan $_POST dan simpan di variabel $nim
            $nim = $_POST['nim'];
            // 2. Ambil password dari form login menggunakan $_POST dan simpan di variabel $password
            $password = $_POST['password'];
            // 3. Buat query untuk mencari mahasiswa berdasarkan NIM dan simpan di variabel $query
            $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
            // 4. Eksekusi query menggunakan mysqli_query dan simpan di variabel $result
            $result = mysqli_query($conn, $query);
            // 5. Ambil hasil query menggunakan mysqli_fetch_assoc dan simpan di variabel $data_mahasiswa
            $data_mahasiswa = mysqli_fetch_assoc($result);
            // 6. Jika data hasil query ditemukan:
            if(mysqli_num_rows($result) == 1) {
                //    - Jika password valid (gunakan password_verify):
                    if(password_verify($password, $data_mahasiswa['password'])){
                        
                //      - Set session login = true
                        $_SESSION["login"] = true;
                //      - Set session user dengan $data_mahasiswa
                        $_SESSION["id"] = $data_mahasiswa["id"];
                //      - Set session message dengan "Login Berhasil"
                        $_SESSION['message'] = "Login Berhasil";
                //      - Jika remember_me dicentang (gunakan isset()):
                //        - Buat cookie untuk nim
                //        - Buat cookie untuk password
                        if (isset($_POST["remember_me"])) {
                            setcookie("id", $data_mahasiswa['nim'], time() + (86400 * 30), "/"); 
                        } else {
                            setcookie("id", $data_mahasiswa['password'], time() - 3600, "/"); 
                        }
                     
                //      - Jika tidak dicentang:
                //        - Hapus cookie nim
                //        - Hapus cookie password
                        if(!isset($_POST['remember_me'])) {
                            setcookie("id", $data_mahasiswa['nim'], time() - 3600, "/");  
                        } else {
                            setcookie("id", $data_mahasiswa['password'], time() - 3600, "/");  
                        }
                        //      - Redirect ke halaman dashboard menggunakan header('Location: index.php?controller=dashboard&action=index')
                        //      - Jangan lupa exit setelah redirect
                        header("Location: index.php?controller=dashboard&action=index");
                        exit;   
                    
                //    - Jika verifikasi password salah, set session message "Login Gagal NIM atau Password Salah"
                } else {
                    $_SESSION['message'] = "Login Gagal NIM atau Password Salah";
                    $_SESSION['color'] = "danger";
                }
                // 7. Jika data hasil query tidak ditemukan, set session message "NIM Tidak Ditemukan"
                } else {
                    $_SESSION['message'] = "NIM tidak ditemukan";
                    $_SESSION['color'] = "danger";
                }
        }
        include 'views/auth/login.php';
    }


    private function getJurusan($jurusan){
        // TODO: Lengkapi fungsi untuk mendapatkan kode jurusan
        // 1. Buat variabel $kode_jurusan dengan nilai default 0
        $kode_jurusan = 0;
        // 2. Gunakan switch-case atau if-else untuk mengatur variabel $kode_jurusan:
        //    - jika jurusan = kedokteran, maka $kode_jurusan = 11
        //    - jika jurusan = psikologi, maka $kode_jurusan = 12
        //    - jika jurusan = biologi, maka $kode_jurusan = 13
        //    - jika jurusan = teknik informatika, maka $kode_jurusan = 14
        switch(strtolower($jurusan)) {
            case 'kedokteran':
                $kode_jurusan == 11;
            break;
            case 'psikologi':
                $kode_jurusan == 12;
            break;
            case 'biologi':
                $kode_jurusan == 13;
            break;
            case 'teknik informatika':
                $kode_jurusan == 14;
            break;
            case 'default':
                $kode_jurusan == 0;
        }
        // 3. Return nilai kode_jurusan
        return $kode_jurusan;
    }

    private function generateNIM($id_pendaftaran){
        $conn = $this->conn;
        // TODO: Lengkapi fungsi untuk generate NIM dengan format: kode_jurusan + tahun_masuk + id_pendaftaran
        // 1. Buat query untuk mengambil data pendaftaran berdasarkan $id_pendaftaran dan simpan di variabel $query
        $query = "SELECT * FROM mahasiswa WHERE id_pendaftaran = 'id_pendaftaran'";
        // 2. Eksekusi query menggunakan mysqli_query dan simpan di variabel $result
        $result = mysqli_query($conn, $query);
        // 3. Ambil hasil query menggunakan mysqli_fetch_assoc dan simpan di variabel $data_pendaftaran
        $data_pendaftaran = mysqli_fetch_assoc($result);
        // 4. Ambil tahun sekarang dalam format 2 digit menggunakan date('y') dan simpan di variabel $tahunmasuk
        $tahun_masuk = date('y');
        // 5. Jika data hasil query ditemukan:
        //    - Ambil data jurusan dari $data_pendaftaran menggunakan $data_pendaftaran['jurusan'] dan simpan di variabel $jurusan
        //    - Dapatkan kode jurusan menggunakan fungsi $this->getJurusan($jurusan) dan simpan di variabel $kode_jurusan
            if(mysqli_num_rows($result) == 1){
                $jurusan = $data_pendaftaran['jurusan'];
                $kode_jurusan = $this->getJurusan($jurusan);
            };
        //    - Jika $kode_jurusan valid (bukan sama dengan 0):
        //      - Buat variabel $nim dengan nilai NIM dengan format: $kode_jurusan + $tahunmasuk + $id_pendaftaran. Opsional: Gunakan str_pad() untuk id_pendaftaran
        //          * Contoh penggunaan str_pad(): str_pad(1, 2, '0', STR_PAD_LEFT) akan menghasilkan '01'
        //          * Contoh NIM: 142301 (14=Teknik Informatika, 24=tahun 2024, 01=ID pendaftaran)
        //      - Return nim
        //    - Return false jika kode jurusan tidak valid
            if($kode_jurusan != 0){
                $nim = $kode_jurusan . $tahunmasuk . str_pad($row['id'], 2, '0', STR_PAD_LEFT);
                return $nim;
            } 
            // 6. Return false jika data tidak ditemukan
            return false;
    }

    public function register_step_1()
    {
        $conn = $this->conn;
        if (isset($_POST['submit'])) {
            // TODO: Lengkapi fungsi register step 1
            // 1. Ambil id_pendaftaran dari form register step 1 dan simpan di variabel $id_pendaftaran
            $id_pendaftaran = $_POST['id_pendaftaran'];
            // 2. Buat query untuk mencari pendaftaran berdasarkan id_pendaftaran dengan status 'lulus' dan simpan di variabel $query
            $query = "SELECT * FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'";
            // 3. Eksekusi query menggunakan mysqli_query dan simpan di variabel $result
            $result = mysqli_query($conn, $query);
            // 4. Ambil hasil query menggunakan mysqli_fetch_assoc dan simpan di variabel $data_pendaftaran
            $data_pendaftaran = mysqli_fetch_assoc($result);
            // 5. Jika data hasil query ditemukan:
            //    - Set session id_pendaftaran dengan $id_pendaftaran
            //    - Redirect ke register step 2 menggunakan header('Location: index.php?controller=auth&action=register_step_2')
            //    - Jangan lupa exit setelah redirect
            if(mysqli_num_rows($result) == 1){
                $_SESSION['id_pendaftaran'] = $data_pendaftaran['id_pendaftaran'];
                header("Location: index.php?controller=auth&action=register_step_2");
                exit;
                // 6. Jika data hasil query tidak ditemukan:
                //    - Set session message error
            } else {
                $_SESSION['message'] = "Password salah";
                $_SESSION['color'] = "danger";
            }

        }
        
        include 'views/auth/register_step_1.php';
    }

    public function register_step_2() 
    {
        $conn = $this->conn;
        // TODO: Cek apakah id_pendaftaran sudah ada di session
        // 1. Jika id_pendaftaran belum ada di session:
        if(isset($_SESSION['id_pendaftaran']) == 0){
            //    - Redirect ke halaman register step 1
            //    - Gunakan header('Location: index.php?controller=auth&action=register_step_1')
            //    - Jangan lupa exit setelah redirect
            header("Location: index.php?controller=auth&action=register_step_1");
            exit;
        }

        if (isset($_POST['submit'])) {
            // TODO: Ambil data dari form register step 2
            // 1. Ambil password dari form dan simpan di variabel $password 
            $password = $_POST['password'];            
            // 2. Ambil confirm_password dari form dan simpan di variabel $confirm_password
            $confirm_password = $_POST['confirm_password'];

            // TODO: Validasi password
            // 1. Cek apakah password sama dengan confirm_password
            if($password == $confirm_password){
                // 2. Jika sama:
                //    - Ambil id_pendaftaran dari session dan simpan di variabel $id_pendaftaran
                //    - Buat query untuk mengambil data pendaftaran berdasarkan id_pendaftaran dan simpan di variabel $query
                //    - Eksekusi query menggunakan mysqli_query dan simpan di variabel $result
                //    - Ambil hasil query menggunakan mysqli_fetch_assoc dan simpan di variabel $data_pendaftaran
                //    - Generate NIM menggunakan fungsi $this->generateNIM($id_pendaftaran) dan simpan di variabel $nim
                //
                //    - Buat query untuk cek apakah NIM sudah ada di database dan simpan di variabel $query_check_nim
                //    - Eksekusi query cek NIM menggunakan mysqli_query dan simpan di variabel $result_check_nim
                //    - Jika NIM sudah ada:
                //      - Set session message "NIM sudah terdaftar"
                //    - Jika NIM belum ada:
                //      - Hash password menggunakan password_hash dengan PASSWORD_DEFAULT dan simpan di variabel $hashed_password
                //      - Ambil nama dari $data_pendaftaran dan simpan di variabel $nama
                //      - Ambil jurusan dari $data_pendaftaran dan simpan di variabel $jurusan
                //      - Buat query INSERT untuk menyimpan data mahasiswa (nim, id_pendaftaran, password, nama, jurusan)
                //      - Eksekusi query INSERT menggunakan mysqli_query dan simpan di variabel $result_insert
                //      - Jika eksekusi query berhasil:
                //        - Set session message berisi informasi bahwa register berhasil dan NIM
                //        - Hapus session id_pendaftaran menggunakan unset()
                //        - Redirect ke halaman login menggunakan header('Location: index.php?controller=auth&action=login')
                //        - Exit setelah redirect
                //      - Jika eksekusi query gagal:
                //        - Set session message "Register Gagal"
                $id_pendaftaran = isset($_SESSION['id_pendaftaram']);
                $query = "SELECT * FROM pendaftaran WHERE id_pendaftaran = '$id_pendaftaran'";
                $result = mysqli_query($conn, $query);
                $data_pendaftaran = mysqli_fetch_assoc($result);
                $nim = $this->generateNIM($id_pendaftaran);

                $query_check_nim = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
                $result_check_nim = mysqli_query($conn, $query_check_nim);
                if(mysqli_num_rows($result_check_nim)==1){
                    $_SESSION['message'] = "NIM sudah terdaftar";
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $nama = $data_pendaftaran['nama'];
                    $jurusan = $data_pendaftaran['jurusan'];
                    $query = "INSERT INTO mahasiswa (nim, id_pendaftaran, password, nama, jurusan) VALUES ('$nim', '$hashed_password', '$nama', '$jurusan')";
                    $result_insert = mysqli_query($conn, $query);
                    if($result_insert){
                        $_SESSION['message'] = "Register Berhasil, NIM: $nim";
                        unset($_SESSION['id_pendaftaran']);
                        header("Location: index.php?controller=auth&action=login");
                        exit;
                    } else {
                        $_SESSION['message'] = "Register Gagal";

                    }

                // 3. Jika password tidak sama:
                //    - Set session message "Password Tidak Cocok"
             
            } 
        } else {
            $_SESSION['message'] = "Password Tidak Cocok";
            }
        
        include 'views/auth/register_step_2.php';
    }
}
        
    public function logout() 
    {
        // TODO: Implementasikan fungsi logout
        // 1. Hapus semua data session menggunakan destroy()
        // 2. Redirect ke halaman login dengan:
        //    - Gunakan header('Location: index.php?controller=auth&action=login')
        //    - Jangan lupa exit setelah redirect
        session_destroy();
        header('Location: index.php?controller=auth&action=login');
        exit;
                
        }
}
?>