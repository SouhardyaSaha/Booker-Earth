
<div class="container pull-left" style="width: 35%" >
  <canvas id="myChart"></canvas>
</div>
<div class="container pull-right" style="width: 60%" >
  <canvas id="BarChart"></canvas>
</div>
{{-- {{$totalBookPosts}} --}}
@section('script')
  
<script>
  let myChart = document.getElementById('myChart').getContext('2d');
  // Global Options
  Chart.defaults.global.defaultFontFamily = 'Lato';
  Chart.defaults.global.defaultFontSize = 15;
  Chart.defaults.global.defaultFontColor = '#777';
  
  let massPopChart = new Chart(myChart, {
    type:'doughnut', // bar, horizontalBar, pie, line, , radar, polarArea
    data:{
      labels:['Book Posts', 'Book Request', 'Sent Messages', 'Received Messages'],
      datasets:[{
        label:'a',
        data:[         
          {{$totalBookPosts}},
          {{$totalBookRequests}},
          {{$messages['totalReceivedMessages']}},
          {{$messages['totalSentMessages']}}                             
        ],
        backgroundColor:'green',
        backgroundColor:[
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(75, 192, 192, 0.6)',
        ],
        borderWidth:1,
        borderColor:'#777',
        hoverBorderWidth:3,
        hoverBorderColor:'#000'
      }]
    },
    options:{
    title:{
      display:true,
      text:'Your Current Status',
      fontSize:20,
      position:'top'
    },
    legend:{
      display:true,
      position:'right',
      labels:{
        fontColor:'#000'
      }
    },
    layout:{
      padding:{
        left:0,
        right:-5,
        bottom:0,
        top:0
      }
    },
    tooltips:{
      enabled:true       
    }
  }
});

const topFiveUsersWithMostBookPosts = "{{$topFiveUsersWithMostBookPosts}}".replace(/&quot;/g, '"');
const topFiveData = JSON.parse(topFiveUsersWithMostBookPosts);

let labels = [], data=[];
labels.push("You");
var a=massPopChart.data.datasets[0].data[0];
data.push(a);

topFiveData.map(item => {
  labels.push(item.name);
  data.push(item.total_book_posts);
});




let BarChart =document.getElementById('BarChart').getContext('2d');

// Global Options
Chart.defaults.global.defaultFontFamily = 'Lato';
Chart.defaults.global.defaultFontSize = 15;
Chart.defaults.global.defaultFontColor = '#777';
let UsersPostChart = new Chart(
  BarChart,{
    type :'bar',
    data:{
      labels : labels,
      datasets:[{
        data : data,
        backgroundColor:[
            'rgba(255, 99, 132, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(54, 162, 235, 0.6)',
            'rgba(255, 206, 86, 0.6)'
        ],
        borderWidth:1,
        borderColor:'#777',
        hoverBorderWidth:3,
        hoverBorderColor:'#000'
      }]
    },
    options:{
      title:{
        display:true,
        text:'Top Five Users',
        fontSize:20,
        position:'top'
      },
      legend:{
        display:false,
        position:'right',
        labels:{
          fontColor:'#000'
        }
      },
      layout:{
        padding:{
          left:0,
          right:-5,
          bottom:0,
          top:0
        }
      },
      tooltips:{
        enabled:true       
      }
    }
  }
)
console.log(UsersPostChart.data.datasets[0].data);
console.log(UsersPostChart.data.labels);
</script>

@endsection
