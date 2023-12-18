<?php 
  var_dump($btct);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quiz</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>

  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
              <span id="countdown" class="text-danger mb-3"></span>
              <div>
                <input type="checkbox" id="nopBaiSom" onclick="hienThiSubmit()">
                <button id="submitBtn" class="btn btn-danger" onclick="submitAssignment()" disabled >Submit</button>
              </div>
            </div>
            <?php foreach ($btct as $bt) : ?>
              <h5 class="card-title">Câu hỏi <?= $bt['idCauHoi'] ?></h5>
              <p class="card-text"><?= $bt['tenCauHoi'] ?></p>
              <!-- Chuyển mảng Thành chuỗi -->
              <?php $danhSachDapAn = explode(',', $bt['tenDapAn']); ?>
              <!-- cho vào vòng lặp để lấy từng phần tử -->
              <!-- Hiển thị số lượng đáp án đúng  -->
              <p><?= $bt['soDapAnDung'] ?></p>
              
              <?php foreach ($danhSachDapAn as $dapAn) : ?>
                <div class="form-check">
                <!-- Toán tử 3 ngôi if($bt['soDapAnDung']) >=2 == true => type : checkbox != true => radio -->
                  <input class="form-check-input" name="answer" value="1"
                  type="<?= ($bt['soDapAnDung'] >= 2) ? 'checkbox' : 'radio' ?>" >
                  <label class="form-check-label" for="answer1"><?= $dapAn ?></label>
                </div>
              <?php endforeach ?>
              <!-- <div class="form-check">
              <input class="form-check-input" type="radio" name="answer" id="answer2" value="2">
              <label class="form-check-label" for="answer2">B. Java là ngôn ngữ lập trình hướng đối tượng</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="answer" id="answer3" value="3">
              <label class="form-check-label" for="answer3">C. Dấu chấm phẩy được sử dụng để kết thúc lệnh trong java</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="answer" id="answer4" value="4">
              <label class="form-check-label" for="answer4">D. Chương trình viết  bằng Java chỉ có thể chạytrên hệ điều hành win</label>
            </div> -->

            <?php endforeach ?>
             

          </div>
          <!-- <button id="nextBtn" class="btn btn-primary mt-3">Next</button> -->
        </div>
      </div>
    </div>
  </div>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script>
    // Countdown timer
    var countdownElement = document.getElementById('countdown');
    var countdownTime = 0.10 * 60;
    var button_Nop_Bai_Thi = document.getElementById('submitBtn');

    function countdown() {
      var minutes = Math.floor(countdownTime / 60);
      var seconds = countdownTime % 60;
      countdownElement.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

      if (countdownTime <= 0) {
        clearInterval(timer);
        
      button_Nop_Bai_Thi.addEventListener('click',()=>{
          alert('Hành động sau khi đếm ngược!');
        })
      
        // button_Nop_Bai_Thi.click();
        document.getElementById('submitBtn').disabled = true;
      }

      countdownTime--;
    }

    var timer = setInterval(countdown, 1000);

    // Nộp bài sớm 

    function hienThiSubmit() {
            var nopBaiSom = document.getElementById("nopBaiSom");
            var submitBtn = document.getElementById("submitBtn");
            // Kiểm tra xem ô checkbox đã được chọn chưa
            if (nopBaiSom.checked) {
                // Gỡ bỏ thuộc tính disable nếu chọn checkbox
                submitBtn.removeAttribute("disabled");
            } else {
                // Nếu không chọn checkbox, đặt lại thuộc tính disable
                submitBtn.setAttribute("disabled", "disabled");
            }
        }

        function submitAssignment() {
            var earlySubmissionCheckbox = document.getElementById("nopBaiSom");

            // Kiểm tra xem ô checkbox đã được chọn chưa
            if (earlySubmissionCheckbox.checked) {
                // Nếu đã chọn checkbox, kiểm tra thời gian làm bài
                var confirmSubmit = confirm("Thời gian làm bài vẫn còn, bạn chắc chắn muốn nộp?");
                if (confirmSubmit) {
                    // Xử lý khi người dùng chấp nhận nộp bài
                    // Đặt các hành động cần thực hiện khi nộp bài ở đây
                    alert("Bài của bạn đã được nộp!");
                    document.getElementById('submitBtn').disabled = true;
                }
            } else {
                // Nếu không chọn checkbox, xử lý nộp bài như thông thường
                // Đặt các hành động cần thực hiện khi nộp bài ở đây
                alert("Bài của bạn đã được nộp!");

            }
        }    

  </script>

</body>

</html>