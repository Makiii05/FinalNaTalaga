<html>
    <body>
        <form method=get action-account.php>
            Account no: <input type=text name=txtaccount><br>
            Name <input type=text name=txtname><input type=submit value=save>
        </form>
        <?php
            $conn=new mysqli("localhost","root", "", "dbfinal");

            if(isset($_GET["txtaccount"])){
                $conn->query("insert into tblaccount (fldaccount, fldname) values ('$_GET[txtaccount]','$_GET[txtname]')");
            }elseif(isset($_GET["txtdelid"])){
                $conn->query("delete from tblaccount where id=$_GET[txtdelid]");
            }

            $result=$conn->query("select * from tblaccount");
            echo "<table border=1><tr><th></th><th>Account No.</th><th>Name</th></tr>";

            while($row=$result->fetch_assoc()){
                echo "<tr>
                <td><a href=account.php?txtdelid=$row[id]>x</a></td><td><a href=ledger.php?txtaccount=$row[fldaccount]>$row[fldaccount]</a></td>
                <td>$row[fldname]</td>";
                }

                echo "</table>";
        ?>
    </body>

</html>