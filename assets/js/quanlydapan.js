function hienAnInput() {
    var themDapAnDiv = document.getElementById('themDapAnDiv');
    var btnThemDapAn = document.querySelector('.btn');

    if (themDapAnDiv.style.display === 'none' || themDapAnDiv.style.display === '') {
        themDapAnDiv.style.display = 'block';
        btnThemDapAn.innerHTML = 'Hủy Thêm Đáp Án';
    } else {
        themDapAnDiv.style.display = 'none';
        btnThemDapAn.innerHTML = 'Thêm Đáp Án';
    }
}