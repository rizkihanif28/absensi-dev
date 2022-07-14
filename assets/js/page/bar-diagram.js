// const ctx = document.getElementById("myChart").getContext("2d");

// const myChart = new Chart(ctx, {
// 	type: "bar",
// 	data: {
// 		labels: [
// 			"Biro SDMOH",
// 			"Biro PKU",
// 			"Inspektorat",
// 			"Direktorat SSPK",
// 			"Direktorat AL",
// 			"Direktorat ALIS",
// 			"PUSDATIN",
// 			"Direktorat PPSPK",
// 			"PUSRISBANG",
// 			"Direktorat PSAK2H",
// 			"Direktorat SPSPK",
// 			"Biro HKLI",
// 			"Direktorat SISHAR",
// 			"Direktorat SNSU MRB",
// 			"Direktorat SNSU TK",
// 			"Direktorat MEETTI",
// 			"Direktorat IPPE",
// 		],
// 		datasets: [
// 			{
// 				label: "WFH",
// 				data: [12, 19, 3, 5, 2, 3, 10, 19, 20, 40, 46, 60, 55, 31, 80, 74, 64],
// 				backgroundColor: "#AFC6FF", //blue
// 			},
// 			{
// 				label: "WFO",
// 				data: [
// 					10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10,
// 				],
// 				backgroundColor: "#FB9333",
// 				borderColor: "rgba(255, 159, 64, 1)",
// 			},
// 		],
// 	},
// 	options: {
// 		animation: {
// 			onComplete: function () {
// 				console.log(myChart.toBase64Image());
// 			},
// 		},
// 		responsive: true,
// 		scales: {
// 			x: {
// 				stacked: true,
// 			},
// 			y: {
// 				beginAtZero: true,
// 				stacked: true,
// 			},
// 		},
// 	},
// });

// // memanggil button download chart
// const add = document
// 	.getElementById("dl-png")
// 	.addEventListener("click", function () {
// 		const bar = document.createElement("a");
// 		bar.href = myChart.toBase64Image();
// 		bar.download = "statistic.png";
// 	});
// // .addEventListener("click", function () {
// //
// // });

// // const bar = document.createElement("a");
// // 		a.href = myChart.toBase64Image();
// // 		bar.download = "statistic.png";
