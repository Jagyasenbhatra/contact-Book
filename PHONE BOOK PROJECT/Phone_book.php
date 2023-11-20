<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Book</title>
    
    <link rel="stylesheet" href="css/phone.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <link rel="stylesheet" href="js/jquery-ui.css">
    <link rel="stylesheet" href="js/jquery-ui.theme.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- input box -->
        <div class="form">
            <div class="input-box">
                <h3>Phone Book</h3>
                    
                <input type="text" placeholder="Name.." id="name">
                <input type="text" placeholder="Mobile No.." id="mobile">
                <input type="text" placeholder="Address.." id="address">
                <button id="btn" disabled="disabled">SAVE</button>
                
            </div>
        </div>
        <!-- update input box -->
        <div class="update-form">
            <div class="input-box">
                <h3>Phone Book</h3>
                <input type="text" placeholder="Name.." class="name" required>
                <input type="text" placeholder="Mobile No.." class="mobile" required>
                <input type="text" placeholder="Address.." class="address" required>
                <input type="hidden" placeholder="id.." id="userid">
                <button id="upd">UPDATE</button>
            </div>
        </div>
        <div class="data">
            <input type="text" placeholder="Search here.." style="width: 200px;" id="search">
            <!-- table -->
            <table border="1" width="100%" id="table">
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            //oparation   on input focus 
            $('input').focus(function () {
                $(this).css("background", "orange")

            })
            $('input').blur(function () {
                $(this).css("background", "")
            })

            // ajax for data display(phone_book_load.php)

            function loadtable() {
                $.ajax(
                    {
                        url: "phone_book_load.php",
                        type: "POST",
                        success: function (result) {
                            $('#table').html(result)
                        }
                    }
                );
            }
            loadtable()

            //ajax for insert data(phone_book_insert.php)

            $('#btn').click(function () {

                var name = $('#name').val()
                var mobile = $('#mobile').val()
                var address = $('#address').val()

                $.ajax(
                    {
                        url: "phone_book_insert.php",
                        type: "POST",
                        data: { a: name, b: mobile, c: address },
                        success: function (result) {

                            loadtable()

                            $('#name').val('')
                            $('#mobile').val('')
                            $('#address').val('')

                            alert('data is saved')
                        }
                    }
                );
            })


            //searching data

            $('#search').keyup(function () {

                var value = $(this).val()
                table_search(value);
            })
             //function for table_search
            function table_search(data) {
                $('#table tr').each(function () {
                    var found = 'false';

                    $(this).each(function () {
                        if ($(this).text().toLowerCase().lastIndexOf(data.toLowerCase()) >= 0) {
                            found = 'true';
                        }
                    })

                    if (found == 'true') {
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }
                }
                )
            }



            //ajax for delete oparation  (phone_book_delete.php)


            $(document).on("click", ".delete-btn", function () {

                var id = $(this).attr('id')

                $.ajax(
                    {
                        url: "phone_book_delete.php",
                        type: "POST",
                        data: { row: id },
                        success: function (result) {
                            loadtable()

                        }
                    }
                );

            })


            //update oparation on (phone_book_update.php)


            $(document).on("click", ".update-btn", function () {

                $('.form').hide()
                $('.update-form').show()

                var id = $(this).attr('id')

                var name = $('#' + id).children('td[target=name]').text()
                var mobile = $('#' + id).children('td[target=mobile]').text()
                var address = $('#' + id).children('td[target=address]').text()

                $('.name').val(name)
                $('.mobile').val(mobile)
                $('.address').val(address)
                $('#userid').val(id)

                //update user
                $('#upd').click(function () {


                    var id = $('#userid').val()

                    var name = $('.name').val()
                    var mobile = $('.mobile').val()
                    var address = $('.address').val()

                    $.ajax(
                        {
                            url: "phone_book_update.php",
                            type: "POST",
                            data: { row: id, name: name, mobile: mobile, address: address },
                            success: function (result) {
                                loadtable()
                                alert('dat is updated')
                             
                                //hide or show for form box
                                $('.form').show()
                                $('.update-form').hide()
                            }
                        }
                    );


                })

            })

             //hide operation on update form
            $('.update-form').hide()

     
     //tooltips
     $('#name,#mobile,#address').on('input change',function(){
        if($('#name').val()!='' && $('#mobile').val()!='' && $('#address').val()!='')
        {
            $('#btn').prop('disabled',false)
        }
        else
        {
            $('#btn').prop('disabled',true)
        }
     })

     $('.name,.mobile,.address').on('input change',function(){
        if($('.name').val()!='' && $('.mobile').val()!='' && $('.address').val()!='')
        {
            $('#upd').prop('disabled',false)
        }
        else
        {
            $('#upd').prop('disabled',true)
        }
     })

        })



// jquery ui
 
$('.form').draggable();
$('.update-form').draggable();

    </script>
</body>

</html>