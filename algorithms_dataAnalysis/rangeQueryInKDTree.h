#ifndef RANGE_QUERY_H
#define RANGE_QUERY_H


#include<iostream>
#include<vector>
#include<cmath>
using std::cout;
using std::endl;
using std::vector;
using std::pair;
namespace cltr {
class kdTreeNode {
public:
pair<double ,double>point;
kdTreeNode*left;
kdTreeNode*right;
friend kdTreeNode * insert_kdTreeNode(kdTreeNode * , double , double , int);
friend void print_kd_tree(kdTreeNode *);
friend void helper(kdTreeNode * root , pair<double,double>p ,int level , double eps , vector<kdTreeNode *>&neigh );
public:
kdTreeNode(double x, double y ) : left(nullptr) , right(nullptr){
point.first = x;
point.second = y;
} 
~kdTreeNode() {
delete left;
delete right;
}
};

kdTreeNode * insert_kdTreeNode(kdTreeNode * , double , double , int );
kdTreeNode * build_kd_tree(vector<pair<double , double>>&);
void helper(kdTreeNode * , pair<double,double> ,int  , double  , vector<kdTreeNode *>& );
vector<kdTreeNode * > searchQuery(kdTreeNode *  , pair<double, double>, double );
void print_neigh_in_range(vector<kdTreeNode *>&);
}

#endif // RANGE_QUERY_H