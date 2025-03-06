#include "concentricClustering.h"
namespace cltr {
inline double convert_to_radian(double deg) {
return (pi/180)*deg;
}
inline double convert_to_degree(double rad) {
  return (180/pi)*rad;
}

double haversine_distance(double rm_lat , double rm_lng) {
////////// converting to radian /////////////
double rm_lat_in_rad = convert_to_radian(rm_lat);
double rm_lng_in_rad = convert_to_radian(rm_lng);
double ku_lat_in_rad = convert_to_radian(ku_lat);
double ku_lng_in_rad = convert_to_radian(ku_lng);
/////////////////////////////////////////////

double half_of_del_lat = (rm_lat_in_rad - ku_lat_in_rad)/2;
double half_of_del_lng = (rm_lng_in_rad - ku_lng_in_rad)/2;

double hav_theta = pow( sin(half_of_del_lat) , 2) + pow(sin(half_of_del_lng) , 2 ) * cos(ku_lat) * cos(rm_lat);

double sin_theta = 2*sqrt(hav_theta);
double theta = asin(sin_theta);
return theta*radius_of_earth;
}

vector<pair<double , double>> latlng_to_coordinates(vector<double>&lat_list , vector<double>&lng_list) {
vector<pair<double, double>>coordinates;
if(lat_list.size()!=lng_list.size()) {
return vector<pair<double, double >>{};
}
double rm_lat_in_rad;
double rm_lng_in_rad;
double ku_lat_in_rad = convert_to_radian(ku_lat);
double ku_lng_in_rad = convert_to_radian(ku_lng);
double x;
double y;
////// ku co-ordinates /////////// 
for(int i=0 ; i<lat_list.size() ;i++) {

rm_lat_in_rad = convert_to_radian(lat_list[i]);
rm_lng_in_rad = convert_to_radian(lng_list[i]);

x = (rm_lng_in_rad - ku_lng_in_rad)*radius_of_earth*cos(ku_lat_in_rad);
y = (rm_lat_in_rad - ku_lat_in_rad)*radius_of_earth;
coordinates.push_back({x,y});
}
return coordinates;
}

vector<pair<double , double>> coordinates_to_latlng(vector<vector<pair<double, double>>> clusters) {
  vector<pair<double , double>> coords;
  double ku_lat_in_rad = convert_to_radian(ku_lat);
double ku_lng_in_rad = convert_to_radian(ku_lng);
  for(int i =0 ; i<clusters.size(); i++) {
    for(int j=0 ; j<clusters[i].size() ; j++) {
      double x = clusters[i][j].first;
      double y = clusters[i][j].second;
      double lng = x/(radius_of_earth*cos(ku_lat_in_rad)) + ku_lng_in_rad;
      double lat = y/(radius_of_earth) + ku_lat_in_rad;
      double lng_in_deg = convert_to_degree(lng);
      double lat_in_deg = convert_to_degree(lat);
      coords.push_back(pair<double , double >(lat_in_deg , lng_in_deg));
    }
  }
  return coords;
  }

//////////////// concentric clustering /////////////////////////////////////////////
vector<vector<clusterpts>> concentricCluster(vector<double>&lat_list , vector<double>&lng_list ,int max_radius , int division) {
vector<clusterpts>pts;
vector<vector<clusterpts>>clusters(division, vector<clusterpts>{});
if(lat_list.size()!=lng_list.size()) {
return vector<vector<clusterpts>>{};
}
for(int i=0 ; i<lng_list.size() ; i++) {
double dist = haversine_distance(lat_list[i] , lng_list[i]);
pts.push_back(clusterpts(lat_list[i] , lng_list[i] , dist));
}

int range = max_radius/division;
for(int i=0 ; i<division ;i++) {
for(auto &pt :pts) {

if(pt.distance <= range*(i+1)) {
clusters[i].push_back(pt);
}
}
}
return clusters;
}

vector<double> haversine_distances(vector<double>& lat_list , vector<double>& lng_list){
vector<double> dist;
for(int i=0 ; i<lat_list.size() ;i++) {
  double distance = haversine_distance(lat_list[i],lng_list[i]);
  dist.push_back(distance);
}
return dist;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////////// printing results ////////////////////////////////////////

void print_coordinates(vector<pair<double , double>>& coordinates) {

for(auto &point : coordinates) {
cout<<"("<<point.first<<","<<point.second<<")"<<" ";
}

}


void print_concentric_cluster(vector<vector<clusterpts>>&point_list) {

for(auto &pts : point_list) {
for(auto &pt : pts) {
cout<<"("<<pt.x<<","<<pt.y<<")"<<"distance-from-KU:"<<pt.distance<< "   ";
}
cout<<endl<<endl<<endl;
}
}
}