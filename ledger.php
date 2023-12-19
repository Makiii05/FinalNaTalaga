
<html>
    <body>
        <a href=account.php> <input type=button value=Accounts></a>

        <form method=get action=ledger.php> 
            Account Number: <input type="text" name="txtaccount" readonly value='<?PHP echo $_GET["txtaccount"]?>'>
            <br>Date: <input type="date" name="txtdate" value="<?PHP echo date('Y-m-d')?>">
            <br>Type: <select name="txttype">
                <option value="debit">Debit</option>
                <option value="credit">Credit</option>
            <br></select>
            <br>Description: <input type='text' name="txtdesc">
            <br>Amount: <input type="number" name=txtamount>
            <br><input type="submit" value=Add>
        </form>
        <?php
        $conn=new mysqli("localhost", "root", "", "dbfinal");
        if(isset($_GET["txttype"])){
            $balance=0;
            $result=$conn->query("SELECT * FROM tblledger WHERE fldaccnt='$_GET[txtaccount]' order by id desc limit 1");
            while($row=$result->fetch_assoc()){ 
                $balance=$row["fldbalance"];
            }
            if($_GET["txttype"]=="debit"){
                $balance=$balance+$_GET["txtamount"];
                $conn->query("insert into tblledger (fldaccnt, flddate, flddesc, flddebit, fldbalance) values ('$_GET[txtaccount]','$_GET[txtdate]','$_GET[txtdesc]',$_GET[txtamount],$balance)");
            }else{
                $balance=$balance-$_GET["txtamount"];
                $conn->query("insert into tblledger (fldaccnt, flddate, flddesc, fldcredit, fldbalance) values ('$_GET[txtaccount]','$_GET[txtdate]','$_GET[txtdesc]',$_GET[txtamount],$balance)");
            }
        }
        ?>
        <?php
            echo "<a href=/funprog/php/final/print.php?txtaccount=$_GET[txtaccount]><input type=button value=Print></a>";
        ?>
        <table border=1>
            <tr><th>Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Balance</th></tr>
            <?php
                $result = $conn->query("SELECT * FROM tblledger WHERE fldaccnt='$_GET[txtaccount]'");
                while($row=$result->fetch_assoc()){ 
                    echo "<tr>
                    <td>$row[flddate]</td>
                    <td>$row[flddesc]</td>
                    <td>$row[flddebit]</td>
                    <td>$row[fldcredit]</td>
                    <td>$row[fldbalance]</td>
                    </tr>";
                }
            ?>
        </table>
    </body>
</html>