const dummyData = {
    points: 100,
    badges: ["Inquisitive", "Solver"],
    rank: 3,
    contestRanks: [5, 2, 8, 4, 1],
  };
  
   document.getElementById("points").textContent = dummyData.points;
  document.getElementById("badges").innerHTML = dummyData.badges.map(badge => <li>${badge}</li>).join("");
  document.getElementById("rank").textContent = dummyData.rank;

  const ctx = document.getElementById("contestGraph").getContext("2d");
  const chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Contest 1', 'Contest 2', 'Contest 3', 'Contest 4', 'Contest 5'],
      datasets: [{
        label: 'Rank',
        data: dummyData.contestRanks,
        borderColor: '#9523d1',
        borderWidth: 2,
        fill: false,
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          reverse: true,
        }
      }
    }
  });