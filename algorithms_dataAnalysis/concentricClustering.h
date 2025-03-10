#ifndef CONCENTRIC_CLUSTER_H
#define CONCENTRIC_CLUSTER_H

#include<iostream>
#include<cmath>
#include<vector>
using std::vector;
using std::pair;
using std::cout;
using std::endl;
const double pi =3.14159265358979323846;
const double ku_lat = 27.619444;
const double ku_lng = 85.538611;
const double radius_of_earth = 6378;

namespace cltr {

  class clusterpts {
double x;
double y;
double distance;
friend vector<vector<clusterpts>> concentricCluster(vector<double>& , vector<double>&lng_list ,int , int );
friend void print_concentric_cluster(vector<vector<clusterpts>>&point_list);
public:
clusterpts(double x, double y , double distance) : x(x) , y(y) , distance(distance) {}
};

inline double convert_to_radian(double);
inline double convert_to_degree(double rad) ;
double haversine_distance(double , double );
vector<pair<double , double>> latlng_to_coordinates(vector<double>& , vector<double>&);
vector<vector<clusterpts>> concentricCluster(vector<double>& , vector<double>& ,int  , int );
void print_coordinates(vector<pair<double , double >>& );
void print_concentric_cluster(vector<vector<clusterpts>>&);
vector<double> haversine_distances(vector<double>& lat_list , vector<double>& lng_list);
vector<pair<double , double>> coordinates_to_latlng(vector<vector<pair<double, double>>> clusters);
}

#endif // CONCENTRIC_CLUSTER_H