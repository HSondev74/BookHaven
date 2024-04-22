<?php
include('./includes/config.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <link rel="shortcut icon" type="image/png" href="./images/logo-brand.png" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="author" content="Le Hong Son">
     <meta content="Le Hong Son" name="Developer">
     <meta name="keywords" content="full designer, full stack designer, lehongson, fullstack web, website, reactjs, backend developer, frontend developer">
     <meta name="description" content="Highly accomplished programmer and Creative with 1+ years of experience">
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
     <link rel="stylesheet" href="./css/variable.css">
     <link rel="stylesheet" href="./css/global.css">
     <link rel="stylesheet" href="./css/Cart.css">
     <link rel="stylesheet" href="./css/Contact.css" />
     <link rel="stylesheet" href="./css/Store.css" />
     <link rel="stylesheet" href="./css/InforCommodity.css" />
     <link rel="stylesheet" href="./css/Payment.css" />
     <link rel="stylesheet" href="./css/LogUp.css" />
     <link rel="stylesheet" href="./css/Login.css" />
     <link rel="stylesheet" href="./css/user_page.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
     <title>
          <?php
          if (isset($_GET['action'])) {
               $stamp = $_GET['action'];
          } else {
               $stamp = null;
          }
          switch ($stamp) {
               case 'chitietsanpham':
                    echo "Book Haven: Chi tiết sản phẩm";
                    break;
               case 'giohang':
                    echo "Book Haven: Giỏ hàng";
                    break;
               case 'search':
                    echo "Book Haven: Tìm kiếm sản phẩm";
                    break;
               case 'lienhe':
                    echo "Book Haven: Liên hệ";
                    break;
               case 'gioithieu':
                    echo "Book Haven: Tuyển dụng";
                    break;
               case 'cuahang':
                    echo "Book Haven: Cửa hàng";
                    break;
               case 'kiemtradonhang':
                    echo "Book Haven: Kiểm tra đơn hàng";
                    break;
               case 'thanhtoan':
                    echo "Book Haven: Thanh toán";
                    break;
               case 'login':
                    echo "Book Haven: Đăng nhập";
                    break;
               case 'logup':
                    echo "Book Haven: Đăng xuất";
                    break;
               default:
                    echo "Book Haven: Trang chủ";
                    break;
          }


          ?>
     </title>
</head>


<body>
     <div>
          <?php
          include('pages/Header.php');
          // include('pages/breadcumb.php');
          include('pages/Content.php');
          include('pages/Footer.php');
          ?>
     </div>



</body>
<script src="./JS/scrollTop.js"></script>
<script src="./JS/carasouel.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
<script type="text/javascript">
     (function() {
          emailjs.init({
               publicKey: "7lf8BbaQzt5NSdIhC",
          });
     })();
</script>
<script>
     function sendMail() {
          var params = {
               name: document.getElementById("name").value,
               email: document.getElementById("email").value,
               message: document.getElementById("message").value
          };

          const serviceID = "service_2lzlru1";
          const templateID = "template_f8wft7a";

          emailjs.send(serviceID, templateID, params).then(res => {
               document.getElementById("name").value = "";
               document.getElementById("email").value = "";
               document.getElementById("message").value = "";
               alert("Bạn đã gửi thông tin thành công!");
          }).catch(err => console.log(err));
     }
</script>
<script src="./JS/map.js"></script>
<script src="./JS/slideShowDetail.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="./JS/scrollHeader.js"></script>
<script src="./JS/chung.js"></script>

<script>
     function changeImage(imageSrc, productId) {
          const product = document.querySelector(`.product[data-id="${productId}"]`);
          if (product) {
               const img = product.querySelector('.product-image img');
               img.src = imageSrc;
          }
     }



     const listFavorites = [];

     function changeFavorites(element, productId) {
          const heartIcon = element.querySelector('i');
          const product = element.closest('.product');
          const productName = product.querySelector('.product-title').textContent;

          const isFavorite = heartIcon.classList.toggle('red');

          if (isFavorite) {
               if (!listFavorites.includes(productId)) {
                    listFavorites.push(productId);
               }
               localStorage.setItem('favorites', JSON.stringify(listFavorites));
               updateFavoritesCount();
               alert("Đã thêm '" + productName + "' vào danh sách yêu thích.");
          } else {
               const index = listFavorites.indexOf(productId);
               if (index !== -1) {
                    listFavorites.splice(index, 1);
                    localStorage.setItem('favorites', JSON.stringify(listFavorites));
                    updateFavoritesCount();
                    alert("Đã xóa sản phẩm '" + productName + "' khỏi danh sách yêu thích.");
               }
          }
     }

     function updateFavoritesCount() {
          const favoritesCount = document.querySelector('.favorite');
          if (favoritesCount) {
               favoritesCount.textContent = listFavorites.length;
          }
     }

     window.onload = function() {
          const storedFavorites = JSON.parse(localStorage.getItem('favorites'));
          if (storedFavorites) {
               listFavorites.push(...storedFavorites);
               const heartIcons = document.querySelectorAll('.heart-product i');
               heartIcons.forEach(icon => {
                    const productId = parseInt(icon.closest('.product').getAttribute('data-product-id'));
                    console.log(productId);
               });

               updateFavoritesCount();
          }
     };
</script>

<script>
     function updateLabelValue(input, labelClass) {
          // Lấy giá trị của input range và định dạng nó thành đơn vị tiền tệ
          var value = input.value;
          var formattedValue = formatCurrency(value);

          // Tìm nhãn tương ứng bằng class name và cập nhật giá trị của nó
          var label = document.querySelector('.' + labelClass);
          label.textContent = formattedValue;
     }

     function formatCurrency(value) {
          // Định dạng giá trị thành đơn vị tiền tệ, ví dụ: 10000000 sẽ thành "10.000.000đ"
          return new Intl.NumberFormat('vi-VN', {
               style: 'currency',
               currency: 'VND'
          }).format(value);
     }

     // var headerHeight = document.querySelector('header').offsetHeight;  
     // document.getElementById('breadcrumb').style.marginTop = headerHeight + 30 + 'px';
     // document.getElementById('breadcrumb').style.marginBottom = '30px';
     // // document.getElementById('main').style.marginTop = headerHeight + 10 + 'px';





     var headerSearchCartAccount = document.querySelector('.header-search-cart-account');

     headerSearchCartAccount.addEventListener("click", function(event) {
          var boxShowAcc = document.querySelector('.box-show-acc');

          if (event.target.closest('.header-search-cart-account')) {
               // Kiểm tra xem box--acc đang được hiển thị hay không
               if (boxShowAcc.style.display === "none" || boxShowAcc.style.display === "") {
                    boxShowAcc.style.display = "block";
               } else {
                    boxShowAcc.style.display = "none";
               }
          } else {
               boxShowAcc.style.display = "none";
          }
     });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/super-build/ckeditor.js"></script>
<script>
     CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
          toolbar: {
               items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                    'htmlEmbed', '|',
                    'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    'textPartLanguage', '|',
                    'sourceEditing'
               ],
               shouldNotGroupWhenFull: true
          },
          list: {
               properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
               }
          },
          heading: {
               options: [{
                         model: 'paragraph',
                         title: 'Paragraph',
                         class: 'ck-heading_paragraph'
                    },
                    {
                         model: 'heading1',
                         view: 'h1',
                         title: 'Heading 1',
                         class: 'ck-heading_heading1'
                    },
                    {
                         model: 'heading2',
                         view: 'h2',
                         title: 'Heading 2',
                         class: 'ck-heading_heading2'
                    },
                    {
                         model: 'heading3',
                         view: 'h3',
                         title: 'Heading 3',
                         class: 'ck-heading_heading3'
                    },
                    {
                         model: 'heading4',
                         view: 'h4',
                         title: 'Heading 4',
                         class: 'ck-heading_heading4'
                    },
                    {
                         model: 'heading5',
                         view: 'h5',
                         title: 'Heading 5',
                         class: 'ck-heading_heading5'
                    },
                    {
                         model: 'heading6',
                         view: 'h6',
                         title: 'Heading 6',
                         class: 'ck-heading_heading6'
                    }
               ]
          },
          placeholder: 'Welcome to you!',
          fontFamily: {
               options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
               ],
               supportAllValues: true
          },
          fontSize: {
               options: [10, 12, 14, 'default', 18, 20, 22],
               supportAllValues: true
          },
          htmlSupport: {
               allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
               }]
          },
          htmlEmbed: {
               showPreviews: true
          },
          link: {
               decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                         mode: 'manual',
                         label: 'Downloadable',
                         attributes: {
                              download: 'file'
                         }
                    }
               }
          },
          mention: {
               feeds: [{
                    marker: '@',
                    feed: [
                         '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                         '@chocolate', '@cookie', '@cotton', '@cream',
                         '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                         '@gummi', '@ice', '@jelly-o',
                         '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                         '@pudding', '@sesame', '@snaps', '@soufflé',
                         '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
               }]
          },
          removePlugins: [
               'AIAssistant',
               'CKBox',
               'CKFinder',
               'EasyImage',
               'MultiLevelList',
               'RealTimeCollaborativeComments',
               'RealTimeCollaborativeTrackChanges',
               'RealTimeCollaborativeRevisionHistory',
               'PresenceList',
               'Comments',
               'TrackChanges',
               'TrackChangesData',
               'RevisionHistory',
               'Pagination',
               'WProofreader',
               // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
               // from a local file system (file://) - load this site via HTTP server if you enable MathType.
               'MathType',
               // The following features are part of the Productivity Pack and require additional license.
               'SlashCommand',
               'Template',
               'DocumentOutline',
               'FormatPainter',
               'TableOfContents',
               'PasteFromOfficeEnhanced',
               'CaseChange'
          ]
     });
</script>


</html>