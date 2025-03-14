const margin = 20;

const upperX_limit = 1;
const upperY_limit = 1;
const total_graph_width =600;
const total_graph_height =600;
const firstQuard_x = total_graph_width/2;
const firstQuard_y = total_graph_height/2;
const scaleX = firstQuard_x/upperX_limit;
const scaleY = firstQuard_y/upperY_limit;
const svg = d3.select('svg');
svg.style('width',total_graph_width);
svg.style("height",total_graph_height);
svg.style('margin','20px');

const origin_x=firstQuard_x;
const origin_y=firstQuard_y;

//  x-axis ////////////////////////
svg.append('line')
.attr('x1',0)
.attr('y1',origin_y)
.attr('x2',2*origin_x)
.attr('y2',origin_y)
.attr('stroke','black')
.attr('stroke-width','3');

// y-axis /////////////////////
svg.append('line')
.attr('x1',origin_x)
.attr('y1',0)
.attr('x2',origin_x)
.attr('y2',2*origin_y)
.attr('stroke','black')
.attr('stroke-width','3');

////////////////////////////////////
const limit_data = [`-${upperX_limit}`, `+${upperX_limit}`,`+${upperY_limit}`, `-${upperY_limit}`];
const visibleFactor=10;
const positions = [
  {x:0,y:origin_y-visibleFactor},
  {x:2*origin_x-visibleFactor-20 , y:origin_y-visibleFactor},
  {x:origin_x+visibleFactor , y:visibleFactor},
  {x:origin_x+visibleFactor , y:2*origin_y}
];

svg.selectAll('.axis_labels').data(limit_data)
.enter()
.append('text')
.attr('class','axis_labels')
.text(d=>d)
.attr('x',(d,i)=>positions[i].x)
.attr('y',(d,i)=>positions[i].y)
.attr('fill','gray')
.attr('font-size','12px');

svg.append('text')
.attr('class','.center')
.text('KU')
.attr('x',origin_x-visibleFactor)
.attr('y',origin_y+visibleFactor/2)
.attr('fill','blue')
.attr('font-size','18px')
.attr('font-weight','700');
//////////////////////////////////////

d3.dsv(',','../algorithms_dataAnalysis/coordinates.csv',d3.autoType).then((data)=>{
  console.log(data);
  svg.selectAll('red-circle')
  .data(data)
  .enter()
  .append('circle')
  .attr('class','red-circle')
  .attr('cx',(d,i)=>{
    return origin_x + d.x_axis*scaleX;
  })
  .attr('cy',(d,i)=>{
    return origin_y - d.y_axis*scaleY;
  })
  .attr('r',3)
  .attr('fill','red')
}).catch(()=>{
  console.log('error');
});

/////////////////////////////////////

setTimeout(()=> {
d3.dsv(',','../algorithms_dataAnalysis/clusteredData.csv',d3.autoType).then((data)=>{
  console.log(data);
  svg.selectAll('.green-circle')
  .data(data)
  .enter()
  .append('circle')
  .attr('class','green-circle')
  .attr('cx',(d,i)=>{
    return origin_x+d.x_axis*scaleX;
  })
  .attr('cy',(d,i)=>{
    return origin_y - d.y_axis*scaleY;
  })
  .attr('r' ,1.3)
  .attr('fill','cyan')
}).catch(()=>console.log('error'));
} , 10);
/////////////////////////////////

setTimeout(()=> {
d3.dsv(',','../algorithms_dataAnalysis/havDistance.csv',d3.autoType).then((data)=>{
  svg.selectAll('.red-circle')
  .data(data)
  .attr('data-dist',(d)=>d.distance);
});
} , 20);
let pointCircle=null;
document.querySelector('svg').addEventListener('mouseover', (e) => {
  console.log(e.target.classList); // Debugging: Check class list
  if (e.target.classList.contains('red-circle')) {
    if(pointCircle!==null) {
      pointCircle.attr('r',3);
    }
   pointCircle = d3.select(e.target);
   d3.select(e.target).attr('r',5);
   console.log(e.target.dataset.dist);
 // Append distance text above the hovered circle
 svg.append('text')
   .attr('class', 'dist-label') // Give it a class for easy removal
   .text(e.target.dataset.dist)
   .attr('x', e.target.getAttribute('cx'))
   .attr('y', e.target.getAttribute('cy') - 18)
   .attr('fill', 'gray')
   .attr('font-size', '12px');

   }
  else {
    d3.select('.dist-label').remove();
    pointCircle.attr('r',3);
  }
});

const back_to_panel = document.querySelector('.back-to-panel');
back_to_panel.addEventListener('click',()=>{
  location.href='adminPage.php';
})