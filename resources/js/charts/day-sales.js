import Chart from "chart.js/auto";
import { API_URL } from "../environment";

const ctx = document.getElementById("sales-month-chart");

async function fillData(month) {
    if (!month || (month && typeof month !== "number")) {
        throw new Error("month must be a number");
    }
    const data = [];
    const salesRequest = await fetch(`${API_URL}/charts/sales/day/${month}`);
    const sales = await salesRequest.json();

    for (let i = 0; i <= 31; i++) {
        data[i] = 0;
    }

    sales.forEach((e) => {
        data[e.day - 1] = e.total;
    });

    return data;
}

async function createChart() {
    const date = new Date();
    const month = date.getMonth() + 1;
    const labels = [];
    const currentMonth = fillData(month);
    const lastMonth = fillData(month - 1);

    for (let i = 1; i <= 31; i++) {
        labels[i - 1] = i;
    }

    const data = {
        labels,
        datasets: [
            {
                label: "Ventas del mes",
                data: await currentMonth,
                fill: false,
                borderColor: "rgb(235, 204, 52)",
                tension: 0.3,
            },
            {
                label: "Ventas del mes anterior",
                data: await lastMonth,
                fill: false,
                borderColor: "rgb(193, 194, 182)",
                tension: 0.3,
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
