
<html>

<style>
table {
    border-spacing: 0 10px;
    font-family: 'Open Sans', sans-serif;

}

th {
    padding: 10px 20px;
    background: #56433D;
    color: #F9C941;
    border-right: 2px solid; 
    font-size: 0.9em;
}

th:first-child {
    text-align: left;
}

th:last-child {
    border-right: none;
}

td {
    vertical-align: middle;
    padding: 10px;
    font-size: 14px;
    text-align: center;
    border-top: 2px solid #56433D;
    border-bottom: 2px solid #56433D;
    border-right: 2px solid #56433D;
}

tr:first-child {
    font-weight: bold;

}
td:first-child {
    border-left: 2px solid #56433D;
}


</style>

    <body>
        <table>
            <tr>
                <td>Client Name</td>
                <td>Client Purse</td>
                <td>Client Currency</td>
                <td>Client Country</td>
                <td>Actions</td>
                <td>Value</td>
                <td>Date Actions</td>
                <td>USD</td>
            </tr>
            <?php
                foreach($data as $client) {
                    echo "<tr>";
                        foreach($client as $value) {
                            echo "<td>";
                            echo  empty($value) ? 'None' : $value;    
                            echo "</td>";
                      
                        }
                    echo "</tr>";
                }
               ?>
               </table>
               <br>
               <table>
               <tr>
                   <td>Total addition</td>
                   <td>Total subtraction</td>
                   <td>USD addition</td>
                   <td>USD subtraction</td> 
                </tr>
                <tr>
                   <td> <?php echo $total['addition']; ?></td>
                   <td> <?php echo $total['subtraction']; ?></td>
                   <td> <?php echo $total['curs_addition']; ?></td>
                   <td> <?php echo $total['curs_subtraction']; ?></td> 
               </tr>
        </table>
    </body>
</html>