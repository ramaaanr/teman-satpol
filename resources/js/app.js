import "./bootstrap";
import "flowbite";
import Alpine from "alpinejs";
import DataTable from "datatables.net-dt";
import { Chart, registerables } from "chart.js"; // Pastikan registerables diimpor
import XLSX from "xlsx";

// Registrasi Chart.js components
Chart.register(...registerables);

// Inisialisasi Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Inisialisasi DataTable
new DataTable("#myTable");

// Ekspos Chart.js ke window agar bisa diakses dari luar
window.Chart = Chart;
window.XLSX = XLSX;
