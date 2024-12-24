const plusButtons = document.querySelectorAll(".plus");
const minusButtons = document.querySelectorAll(".minus");
const nums = document.querySelectorAll(".num");
const quantities = Array.from({ length: plusButtons.length }, () => 1);

plusButtons.forEach((plus, index) => {
  plus.addEventListener("click", () => {
    quantities[index]++;
    updateQuantity(index);
  });
});

minusButtons.forEach((minus, index) => {
  minus.addEventListener("click", () => {
    if (quantities[index] > 1) {
      quantities[index]--;
      updateQuantity(index);
    }
  });
});

function updateQuantity(index) {
  let a = quantities[index];
  a = a < 10 ? "0" + a : a;
  nums[index].innerText = a;
  console.log(a);
}





window.addEventListener('DOMContentLoaded', function() {
    // Lấy phần tử overlay và content
    var overlay = document.querySelector('.overlay');
    var content = document.querySelector('.content');
    // Ẩn overlay và hiển thị nội dung sau 1 giây
    setTimeout(function() {
        overlay.style.opacity = 0;
        overlay.style.visibility = 'hidden';
        content.classList.add('show');
    }, 1000);
  });


  // Logo

