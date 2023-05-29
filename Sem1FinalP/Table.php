<html>
<body style="background-color: bisque " >
<div>    
<?php 
if(isset($_COOKIE["loggedin"])){
    include 'menuu.php';
  }else if(isset($_COOKIE["Manager"])){
    include 'menum.php';
  }else{
    include 'menu.php';
  }
?>
</div>
<br>
<br>
<br>
<center>
<h1 style='color:Red'> Information about Every Type of the Items </h1>
</center>
<center>
<table  style='border-collapse:separate;border-spacing: 50px;'>
<tr>
    <th style='color:Blue'>Mother-Board </th>
    <th style='color: black'>CPU</th>  
    <th style='color:Brown'> RAM</th>
    <th style='color:Orange'>GPU</th>
    <th style='color:Black'>Storage SSD/HDD</th>
</tr>
<tr>
<td style='color:Blue'>A motherboard is the main printed circuit board (PCB) in a computer. The motherboard is a computer's central communications backbone connectivity point, through which all components and external peripherals connect.</td>
<td style='color:Yellow'>The component of a computer system that controls the interpretation and execution of instructions. The CPU of a PC consists of a single microprocessor, while the CPU of a more powerful mainframe consists of multiple processing devices, and in some cases, hundreds of them. The term “processor” is often used to refer to a CPU.</td>
<td style='color:Brown'>RAM (random access memory) is a computer's short-term memory, where the data that the processor is currently using is stored. Your computer can access RAM memory much faster than data on a hard disk</td>
<td style='color:Orange'>Graphics processing technology has evolved to deliver unique benefits in the world of computing. The latest graphics processing units (GPUs) unlock new possibilities in gaming, content creation, machine learning, and more.</td>
<td style='color:Black'>A hard disk drive (HDD), hard disk, hard drive, or fixed disk,[b] is an electro-mechanical data storage device that stores and retrieves digital data using magnetic storage with one or more rigid rapidly rotating platters coated with magnetic material. The platters are paired with magnetic heads</td>
</tr>
</table>
</center>
</body>
</html>