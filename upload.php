<?php
    if($_FILES){
        /* Dosya Adını Düzeltme Fonksiyonu */
            // Yüklenen dosya adındaki türkçe karakterleri değiştirir
            function renamefile($filename) {
                $find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '-');
                $replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', ' ');
                $filename = strtolower(str_replace($find, $replace, $filename)); // str_replace() ile türkçe karakterleri değiştiriyoruz. strtolower() ile büyük harfleri küçük harfe dönüştürüyoruz.
                $filename = str_replace(' ', '-', $filename); // str_replace() fonksiyonu ile boşlukları - yapıyoruz.
                return $filename;
            }
        /* Dosya Adını Düzeltme Fonksiyonu */
        $uploadfolder = 'upload'; // Dosyanın yükleneceği klasörü yolunu yazıyoruz.
        $file = $_FILES['file']; // $_FILES ile gelen verileri değişkene atıyoruz.
        // $formats = array("application/pdf", "application/doc", "application/docx", "application/xls", "application/xlsx"); // Dokümanlar için PDF, Word, Excel formatları
        $formats = array("image/pjpeg", "image/jpeg", "image/gif", "image/bmp", "image/x-png", "image/png"); // Resimler için Jpg, Gif, Bmp, Png formatları
        // $formats = array("video/mp4", "video/mpg", "video/mpeg", "video/mov", "video/avi", "video/flv", "video/wmv"); // Videolar için Mp4, Mpg, Mov, Avi, Flv, Wmv formatları
        $url_decode = urldecode($file['name']);
        $name = explode('/', $url_decode);
        $rand = time(); // Random bir değer atamak için burada zamanı alıyoruz.
        if (in_array($file['type'], $formats)) {
            // Yüklemek istenilen dosyanın izin verilen dosya formatlarına uygunluğunu kontrol ediyoruz.
            $upload_file = $uploadfolder.'/'.$rand.renamefile($name[count($name) - 1]);
            move_uploaded_file($file['tmp_name'], $upload_file);
            $filename = $rand.renamefile($name[count($name) - 1]);
            echo '<div class="alert alert-success text-center"><strong>İşlem Başarılı.!</strong> Dosya başarıyla yüklendi.<br><br><a href="'.$uploadfolder.'/'.$filename.'" class="btn btn-success btn-xs" target="_blank">Dosyayı Görüntüle</a></div>'; // İşlem başarılı ise sonucu ekrana yazdırıyoruz.
        }else{
            echo '<div class="alert alert-danger"><strong>Hata.!</strong> Bir hata oluştu lütfen web yöneticinize başvurunuz. Yanlış Dosya Formatı veya boyut sınırı aşıyor.</div>'; // Eğer dosya formatı izin verdiğimiz formatlara uygun değilse hata mesajını ekrana yazdırıyoruz.
        }
    }
?>