<?php
session_start();

$foto = isset($_COOKIE['foto']) ? 'uploads/' . $_COOKIE['foto'] : 'default.png';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV</title>
    <link rel="stylesheet" href="cv.css">
</head>
<body>
    <header class="cv-header">
        <div class="profile-container">
                <img src="<?php echo isset($_COOKIE['foto']) && file_exists($_COOKIE['foto']) ? $_COOKIE['foto'] : 'default.png'; ?>" 
                    alt="Foto Profil" class="foto-profil">
                <div class="profile-info">
                    <h1 class="name"><?php echo $_COOKIE['nama'] ?? 'Nama Anda'; ?></h1>
                    <h2 class="job"><?php echo $_COOKIE['pekerjaan'] ?? 'Pekerjaan Anda'; ?></h2>
                </div>
            </div>
    </header>
    
    <div class="cv-container">
        <div class="content">
            <section class="profile">
                <h3>PROFIL</h3>
                <p class="ttl">Tanggal Lahir:</strong> <?php echo $_COOKIE['ttl'] ?? '-'; ?></p>


                <div class="kontak">
                    <h4>Kontak</h4>
                    <div class="kontakdesc">
                        <p class="contact"> <?php echo $_COOKIE['email'] ?? '-'; ?> </p>
                        <p class="contact"> <?php echo $_COOKIE['no_hp'] ?? '-'; ?> </p>
                    </div>
                </div>
            </section>


            <section class="education">
                
                <h3>RIWAYAT PENDIDIKAN</h3>
                <div class="smadesc">
                    <div class="tahun">
                        <?php echo $_COOKIE['tahun_sma'] ?? '-'; ?>
                    </div>
                    <p class="edu-title"><strong> <?php echo $_COOKIE['sma'] ?? '-'; ?></strong></p>
                    <p>(Jurusan) - GPA: <?php echo $_COOKIE['gpa_sma'] ?? '-'; ?></p>
                </div>
                
                <div class="univdesc">
                    <div class="tahun">
                    <?php echo $_COOKIE['tahun_pt'] ?? '-'; ?>
                    </div>
                    <p class="edu-title"><strong> <?php echo $_COOKIE['pt'] ?? '-'; ?></strong></p>
                    <p>S-1 (Jurusan) - GPA: <?php echo $_COOKIE['gpa_pt'] ?? '-'; ?></p>
                </div>
                
            </section>
        </div>
        
        <form action="logout.php" method="post">
            <button type="submit" class="logout">Logout</button>
        </form>

    </div>

</body>
</html>
