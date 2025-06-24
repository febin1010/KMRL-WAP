export async function initializeCharts() {
  try {
    const response = await fetch('../api/dashboard_stats.php');
    const json = await response.json();
    const data = json.data;

    // Inject Total WAPs, Pending WAPs, Expired WAPs counts
    const totalEl = document.getElementById('totalWaps');
    const pendingEl = document.getElementById('pendingWaps');
    const expiredEl = document.getElementById('expiredWaps');

    if (data?.totals) {
      if (totalEl) totalEl.textContent = data.totals.total;
      if (pendingEl) pendingEl.textContent = data.totals.pending;
      if (expiredEl) expiredEl.textContent = data.totals.expired;

      // Inject trend values (top-right)
      const totalTrend = document.getElementById('totalTrend');
      const pendingTrend = document.getElementById('pendingTrend');
      const expiredTrend = document.getElementById('expiredTrend');

      if (totalTrend) totalTrend.textContent = `${data.totals.trends.total}%`;
      if (pendingTrend) pendingTrend.textContent = `${data.totals.trends.pending}%`;
      if (expiredTrend) expiredTrend.textContent = `${data.totals.trends.expired}%`;
    }

    // Expiring Soon widget
    const expiringSoonEl = document.getElementById('expiringSoon');
    if (expiringSoonEl && data.expiringSoon !== undefined) {
      expiringSoonEl.textContent = data.expiringSoon;
    }

    // Clean up existing charts
    if (window.pieChart) window.pieChart.destroy();
    if (window.barChart) window.barChart.destroy();
    if (window.lineChart) window.lineChart.destroy();

    const pieCtx = document.getElementById('wapPieChart')?.getContext('2d');
    const barCtx = document.getElementById('deptBarChart')?.getContext('2d');
    const lineCtx = document.getElementById('monthlyWAPs')?.getContext('2d');

    // Pie Chart
    if (pieCtx) {
      window.pieChart = new Chart(pieCtx, {
        type: 'pie',
        data: {
          labels: Object.keys(data.statuses),
          datasets: [{
            data: Object.values(data.statuses),
            backgroundColor: ['#10B981', '#F59E0B', '#EF4444']
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      });
    }

    // Bar Chart
    if (barCtx) {
      window.barChart = new Chart(barCtx, {
        type: 'bar',
        data: {
          labels: Object.keys(data.departments),
          datasets: [{
            label: 'WAPs Issued',
            data: Object.values(data.departments),
            backgroundColor: ['#3B82F6', '#10B981', '#6366F1', '#F43F5E', '#FBBF24', '#34D399', '#8B5CF6']
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: { beginAtZero: true }
          },
          plugins: { legend: { display: false } }
        }
      });
    }

    // Line Chart
    if (lineCtx) {
      window.lineChart = new Chart(lineCtx, {
        type: 'line',
        data: {
          labels: data.months,
          datasets: [{
            label: 'WAPs Issued',
            data: data.monthCounts,
            borderColor: '#6D28D9',
            backgroundColor: 'rgba(109, 40, 217, 0.1)',
            tension: 0.4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: { beginAtZero: true }
          },
          plugins: {
            legend: { display: false }
          }
        }
      });
    }

  } catch (err) {
    console.error('Chart Load Error:', err);
  }
}
