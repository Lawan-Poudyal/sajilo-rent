#ifndef DENSITY_CLUSTER_H
#define DENSITY_CLUSTER_H

#include<iostream>
#include<vector>
#include<cmath>
#include<queue>
#include<unordered_set>
using namespace std;
namespace cltr {
class node {
public:
pair<double ,double>point;
node*left;
node*right;
friend node * insert_node(node * root , double x , double y , int level , vector<node *>&allNodes );
friend void print_kd_tree(node *);
friend void helper(node * root , pair<double,double>p ,int level , double eps , vector<node *>&neigh );
friend void printClusters(vector<pair<double ,double>>&v ,double eps , double minpts);
public:
node(double x, double y ) : left(nullptr) , right(nullptr){
point.first = x;
point.second = y;
} 
~node() {
delete left;
delete right;
}
};

node * insert_node(node *  , double  , double  , int  , vector<node *>& );
node * build_kd_tree(vector<pair<double , double>>& , vector<node *>&);
void helper(node * , pair<double,double> ,int  , double  , vector<node *>&);
vector<node * > searchQuery(node * , pair<double, double>, double );
vector<vector<pair<double ,double>>> getClusters(vector<pair<double ,double>>& ,double , double );
void printDensityClusters(vector<vector<pair<double,double>>>);
}

#endif // DENSITY_CLUSTER_H