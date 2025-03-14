#include<iostream>
#include<fstream>
#include<iomanip>
#include<string>
#include <type_traits>
#include "concentricClustering.h"
#include "densityClustering.h"
#include "rangeQueryInKDTree.h"

using namespace std;
using namespace cltr;


//////////////// writing on csv files ////////////////////////////////////
void writeFileCoordinates(string fileName , vector<pair<double,double>> coordinates) {
fstream myFile;
myFile.open(fileName , ios::out);
if(myFile.is_open()){
  myFile<<"x_axis,y_axis";
  for(auto &it :coordinates) {
    myFile<<"\n"<<it.first<<","<<it.second;
  }
myFile.close();
}
}

///////////
void writeFileLatLng(string fileName, vector<pair<double, double>> lat_lng) {
  fstream myFile;
  myFile.open(fileName, ios::out);
  if (myFile.is_open()) {
      myFile << "x_axis,y_axis";
      myFile << fixed << setprecision(12); // Apply fixed precision globally  
      for (auto &it : lat_lng) {
          myFile << "\n" << it.first << "," << it.second;
      }
      myFile.close();
  }
}


void writeFileClusterCoords(string fileName , vector<vector<pair<double,double>>> coordinates) {
  fstream myFile;
  myFile.open(fileName , ios::out);
  if(myFile.is_open()) {
    myFile<<"x_axis,y_axis";
for(auto points : coordinates) {
  for(auto point : points){
    myFile<<"\n"<<point.first<<","<<point.second;
  }
}
myFile.close();
  } 
}

void writeFileDistance(string fileName , vector<double>&dist) {
  fstream myFile;
  myFile.open(fileName , ios::out);
  if(myFile.is_open()){
    myFile<<"distance";
    for(auto &it : dist){
      myFile<<"\n"<<it;
    }
  }
}
//////////////////////////////////////////////////////////////

/////////// reading lat and lng form txt file/////////
vector<double>readFile(string fileName) {
  vector<double>lat_or_lng;
  fstream myFile;
  myFile.open(fileName, ios::in);
  if(myFile.is_open()) {
    string line;
    while(getline(myFile,line)){
      lat_or_lng.push_back(stod(line));
    }
  }
  myFile.close();
  return lat_or_lng;
}









int main() {
vector<double>lat_list=readFile("../adminPanel/lat.txt");

vector<double>lng_list=readFile("../adminPanel/lng.txt");

////////// concentric clustering ///////////////////////////////////////////////
vector<pair<double , double >> coordinates = latlng_to_coordinates(lat_list , lng_list);
print_coordinates(coordinates);
writeFileCoordinates("coordinates.csv",coordinates);
cout<<endl;
vector<vector<clusterpts>> point_list = concentricCluster(lat_list , lng_list , 20, 2 );
print_concentric_cluster(point_list);

//////////////// printing distances from ku ///////////////////////////////////
vector<double>distances = haversine_distances(lat_list,lng_list);
writeFileDistance("havDistance.csv",distances);

//////////////////////////////////////////////////////////////////////  

/////////////////////////// search rents from choosen location and choosen range /////////////////////////
vector<pair<double , double >> v=coordinates;
kdTreeNode * root = build_kd_tree(v);
vector<kdTreeNode * > neigh = searchQuery(root , pair<int,int>(12,8) ,10);
print_neigh_in_range(neigh);
delete root;

///////////////////////////// density clustering //////////////////////////////////////////
vector<pair<double, double>> points = coordinates;
float epsilonRadius = 0.1;
int minPoints=6;
vector<vector<pair<double, double>>> clusters = getClusters(points,epsilonRadius , minPoints);
printDensityClusters(clusters);
writeFileClusterCoords("clusteredData.csv",clusters);


////////////////////// lat lng clustered data/ ///////////////////////////////
vector<pair<double , double>> coords = coordinates_to_latlng(clusters);
writeFileLatLng("clusteredData_latlng.csv" , coords);
for(auto & it : coords) {
  cout<<it.first<<"            " <<it.second;
}
return 0;
}