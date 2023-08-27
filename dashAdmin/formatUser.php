<style>
.styled-table {
    width: 100%;
    margin: 20px 0;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
}

.styled-table thead tr {
    background-color: #009879;
    color: white;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

.styled-table tbody tr {
    border-bottom: 1px solid #ddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

.styled-table tbody tr:hover {
    background-color: #cccccc;
}

.styled-table a {
    color: #ff6347;
    text-decoration: none;
}

.styled-table a:hover {
    color: #009879;
    text-decoration: underline;
}
.styled-table .delete-button {
    background-color: #ff6347; /* The color of the button */
    color: white; /* The color of the text */
    border: none; /* Remove the border */
    border-radius: 5px; /* Rounded corners */
    padding: 5px 10px; /* Padding around the text */
    cursor: pointer; /* Change the cursor when hovering */
    text-decoration: none; /* Remove the underline */
    font-size: 0.9em; /* The size of the text */
    transition: background-color 0.3s ease; /* Transition for hover effect */
}

.styled-table .delete-button:hover {
    background-color: #cc0000; /* Change the color when hovering */
}






.styled-table th,
.styled-table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    vertical-align: middle; /* Align the content in the middle */
}

.styled-table .delete-button {
    display: inline-block; /* To allow width and height */
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    background-color: #ff6347;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px; /* Adjust as needed */
    cursor: pointer;
    text-decoration: none;
    font-size: 0.9em;
    transition: background-color 0.3s ease;
    text-align: center; /* Center the text */
    line-height: normal; /* Adjust as needed */
    box-sizing: border-box; /* Padding will not affect the width and height */
}

.styled-table .delete-button:hover {
    background-color: #cc0000;
}
</style>

