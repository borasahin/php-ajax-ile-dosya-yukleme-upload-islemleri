$('#uploadForm').on('submit',function(e){
	e.preventDefault();
	$.ajax({
		url: 'upload.php', // Verileri Post Ettiğimiz dosya adı
		type: 'POST', // Form Metodumuz
		data: new FormData(this), // Form ile gelen verilerimiz
		contentType: false,
		processData: false,
		beforeSend: function(){
			// Form Post edildikten sonra yapılacak işlem
			$('#result').html('<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;"><span class="sr-only">Lütfen Bekleyiniz....</span></div></div>');
		},
		success: function(data){
			// upload.php dosyamıza verilerin gönderildikten sonra işlem başarılı ise upload.php ile gelen sonuç değerini yazdıracağımız satır
			$('#result').html(data);
			$('#uploadForm')[0].reset(); // İşlem başarılı olduktan sonra formu sıfırlar
		}
	});
});
