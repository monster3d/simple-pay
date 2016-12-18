
<html>

<style>

table {
color: #333;
font-family: Helvetica, Arial, sans-serif;
width: 640px;
border-collapse:
collapse; border-spacing: 0;
}

td, th {
border: 1px solid transparent; /* No more visible border */
height: 30px;
transition: all 0.3s; /* Simple transition for hover effect */
}

th {
background: #DFDFDF; /* Darken header a bit */
font-weight: bold;
}

td {
background: #FAFAFA;
text-align: center;
}

tr:nth-child(even) td { background: #F1F1F1; }
tr:nth-child(odd) td { background: #FEFEFE; }
tr td:hover { background: #666; color: #FFF; } /* Hover cell effect! */
</style>

    <body>
        <table style=" width: 640px;">
            <tr>
                <td>Client Name</td>
                <td>Client Purse</td>
                <td>Client Country</td>
                <td>Actions</td>
                <td>Value</td>
                <td>Date Actions</td>
            </tr>
            <?php
                foreach($data as $client) {
                    echo "<tr>";
                        foreach($client as $value) {
                            echo "<td>";
                            echo $value;    
                            echo "</td>";
                      
                        }
                }
               ?>
               <tr>
                   <td>Total addition: </td>
                   <td> <?php echo $addition; ?></td>
               </tr>
               <tr>
                    <td>Total subtraction: </td>
                    <td> <?php echo $subtraction; ?></td>
               </tr>
        </table>
    </body>
</html>