

#include "rangeQueryInKDTree.h"
namespace cltr {
kdTreeNode * insert_kdTreeNode(kdTreeNode * root , double x , double y , int level ) {
//////base case////////////
if(root == nullptr) {
root = new kdTreeNode(x,y);
return root;
}
////////////
if(level%2==1) {
if(x>root->point.first) {
root->right=insert_kdTreeNode(root->right , x, y ,level+1);
}
else {
root->left = insert_kdTreeNode(root->left , x , y, level+1);
}
} /// comparing with x 

else {
if(y>root->point.second) {
root->right = insert_kdTreeNode(root->right , x, y , level+1);
}
else {
root->left = insert_kdTreeNode(root->left , x , y , level+1);
}
} /// comparing with y 
return root;
}



kdTreeNode * build_kd_tree(vector<pair< double , double>>&v) {
kdTreeNode *root = nullptr;
for(int i=0 ; i<v.size() ; i++) {
root = insert_kdTreeNode(root ,v[i].first , v[i].second, 1);
}
return root;
}

void print_kd_tree(kdTreeNode * root) {
//////////// base case ///////////////////
if(root == nullptr) {
return;
}

cout<<root->point.first<<" "<<root->point.second;
cout<<endl;

print_kd_tree(root->left);
print_kd_tree(root->right);

}

void helper(kdTreeNode * root , pair<double,double>p ,int level , double eps , vector<kdTreeNode *>&neigh ) {
///////// base case ////////////////////
if(root==nullptr) {
return;
}

///////////////// printing the nearest neighbours within radius epsilon  ///////////////////////
float dist = sqrt( pow( (p.first - root->point.first) , 2 ) + pow( (p.second-root->point.second) , 2) );
if(dist <= eps && !(p.first == root->point.first && p.second == root->point.second)) {
neigh.push_back(root);
}


////////////////////////////

/////////// main area ///////////////////
if(level%2==1) {
double delx = p.first - root->point.first;

if(abs(delx) > eps) {

if(delx<0) {
helper(root->left , p , level+1 , eps , neigh);
} else {
helper(root->right , p , level+1 , eps , neigh);
}
}
else {
helper(root->left , p , level+1 , eps , neigh);
helper(root->right , p , level+1 , eps ,neigh);
}
}
else {
double dely = p.second -root->point.second;
if(abs(dely) >eps) {

if(dely<0) {
helper(root->left , p , level+1 , eps , neigh);
} else {
helper(root->right , p , level+1 , eps , neigh);
}
}
else {
helper(root->left , p , level+1 , eps , neigh);
helper(root->right , p , level+1 , eps ,neigh);
}
}
} /////// end-of-helper

vector<kdTreeNode * > searchQuery(kdTreeNode * root , pair<double, double>p, double eps) {
vector<kdTreeNode *>neigh;
helper(root , p , 1 , eps ,neigh);
return neigh;
}

/////////////////// printing the neighbours ///////////////////////
void print_neigh_in_range(vector<kdTreeNode *>&neigh) {
for(auto & it : neigh) {
cout<<"("<<it->point.first<<","<<it->point.second<<")"<<" ";
}
}
}










