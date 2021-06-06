import Chart from "chart.js/auto";
import { API_URL } from "../environment";

const ctx = document.getElementById("sales-chart");
const labels = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
];
async function createChart() {
    const salesYear = await fetch(`${API_URL}/charts/sales`);
    const salesYearParsed = await salesYear.json();

    const datasetYear = [];
    salesYearParsed.forEach((e) => {
        datasetYear[e.Month - 1] = e.total;
    });

    const data = {
        labels,
        datasets: [
            {
                label: "Ventas del año",
                data: datasetYear,
                fill: false,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
            },
        ],
    };

    const config = {
        type: "line",
        data,
    };

    new Chart(ctx, config);
}

if (ctx) {
    createChart();
}
