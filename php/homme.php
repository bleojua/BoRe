<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BoRe</title>
        <link rel="stylesheet" href="../css/homepage.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    </head>

    <body>
        
        <div id="meniuBar" class="meniuBar">

            <div class="tooltipButton">
                <button id="home" class="meniuBtn"><img class="buttonImage" src="../images/home.png"></button>
                <spam class="tooltipInfo">Home</spam>
            </div>

            <input type="search" id="searchBar" class="searchBar" placeholder="search here...">
            
            <div class="meniuDiv">

                <div class="tooltipButton">
                    <button id="groups" class="meniuBtn"><img class="buttonImage" src="../images/group.png"></button>
                    <spam class="tooltipInfo">My Groups</spam>
                </div>

                <div class="tooltipButton">
                    <button id="mybooks" class="meniuBtn" onclick="window.location.href='../php/MyBooks.php';"><img class="buttonImage" src="../images/book.png"></button>
                    <spam class="tooltipInfo">My Books</spam>
                </div>

                <div class="tooltipButton">
                    <button id="notifications" class="meniuBtn"><img class="buttonImage" src="../images/notification.png"></button>
                    <spam class="tooltipInfo">Notifications</spam>
                </div>

                <div class="tooltipButton">
                    <button id="profile" class="meniuBtn" onclick="window.location.href='../php/Profile.php';" ><img class="buttonImage" src="../images/user (1).png"></button>
                    <spam class="tooltipInfo">Profile</spam>
                </div>
                
            </div>
                
        </div>

        <div class="postCards" id="postCards">
            
            <?php

                $con = mysqli_connect('localhost','root','','boredb');
            
                if (!$con) {
            
                    die('Could not connect: ' . mysqli_error($con));
            
                }
            
                $sql="SELECT * FROM carti";
            
                $result = mysqli_query($con,$sql);
            
                $max=0;
            
                while($row = mysqli_fetch_array($result) ){
            
                    //in while => and $max<5
            
                    echo "
                        <div class=postCard id=postCard>
                            
                            <img class=postCard id=postCardImage src=../images/".$row["imagine"]." alt=".$row["titlu"].">
                        
                            <div class=postCard id=postCardContent>
                            
                                <div id=titluautorbuton>
                                    
                                    <div class='titluAutor'>
                                        <p id='titlu'>".$row["titlu"]."</p>
                                        <p id='autor'>by ".$row["autor"]." </p>
                                        <p id='gen'>".$row["gen"]."</p>

                                    </div>

                                
                                </div>

                                <div id='descriereDiv'>
                                    <p id=decriere>".$row["descriere"]."</p>
                                </div>

                            </div>
                            
                            <button type=button onclick='AddBook();' id='addBook'> <img src='../images/reading.png' id='addBookIcon'></button>

                        </div>"
                    ;
                    $titlu = $row["titlu"];
                    $autor = $row["autor"];
                    $gen = $row["gen"];
                    $bookid = $row["bookID"];

                    // $max++;
                }

                $con->close();
            ?>

        </div>

    </body>

<!-- echo:::    $payload = file_get_contents('php://input'); -->
<!-- $payload = file_get_contents('php://input'); -->

    <script>


        // $("#profile").click(
        //     function(e){
                
        //         location.replace("../php/Profile.php");
        //     }
        // )
        
        $("#mybooks").click(
            function(e){
                
                location.replace("../php/MyBooks.php");
            }
        )

        $("#addBook").click(
            
            function(){
                location.replace("../php/MyBooks.php");
            }
        )
    

        function AddBook()
        {

            alert("hello");
            $.ajax({

                type:    'post',
                url: 'AddBook.php',
                data:
                {
                    titlu:$("#titlu").val(),
                    autor: $("#autor").val(),
                    gen: $("#gen").val()
                },
                dataType: "JSON",
                // alert(data)
                success: function(data)
                {
                    alert(data);
                    if(data=='guest')
                    {
                        alert('orice');
                        location.replace('LogIn.php');
                        alert('you are connected as a '+data+'. login!');
                    }
                    else{
                        alert(data);
                    }

                    //data returned from php
                }
                // function
        
            });

        }


        // function hello(){
        //     $.ajax(
        // {     
        // type:    'post',
        // url:     'AddBook.php',
        // data:    '&id=' + $('#id').val() + '&name=' +     $('#name').val(),
        // dataType: 'json',
        // //alert(data);
        // success: function(data) 
        // {
        // //alert(data);
        // }   
        // });
        // }

    </script>

</html>