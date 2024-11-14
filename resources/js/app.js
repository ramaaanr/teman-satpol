import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import DataTable from "datatables.net-dt";

let table = new DataTable("#myTable");
window.Alpine = Alpine;

Alpine.start();
