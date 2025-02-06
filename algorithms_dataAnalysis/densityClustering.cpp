/*DBSCAN categorizes points into:

Core points → minpts or more neighbors in eps → Expands the cluster.
Border points → Fewer than minpts but within eps of a core → Part of the cluster, but does NOT expand.
Noise points → Not reachable by any core → Ignored.

*/
// the algorithm implements dbscan but does not level the points as core , noise and border points.
#include "densityClustering.h"
namespace cltr { 
node * insert_node(node * root , double x , double y , int level , vector<node *>&allNodes ) {
//////base case////////////
if(root == nullptr) {
root = new node(x,y);
allNodes.push_back(root);
return root;
}
////////////
if(level%2==1) {
if(x>root->point.first) {
root->right=insert_node(root->right , x, y ,level+1 , allNodes);
}
else {
root->left = insert_node(root->left , x , y, level+1 , allNodes);
}
} /// comparing with x 

else {
if(y>root->point.second) {
root->right = insert_node(root->right , x, y , level+1 , allNodes);
}
else {
root->left = insert_node(root->left , x , y , level+1 , allNodes);
}
} /// comparing with y 
return root;
}



node * build_kd_tree(vector<pair<double , double>>&v , vector<node *>&allNodes) {
node *root = nullptr;
for(int i=0 ; i<v.size() ; i++) {
root = insert_node(root ,v[i].first , v[i].second, 1 , allNodes);
}
return root;
}

void print_kd_tree(node * root) {
//////////// base case ///////////////////
if(root == nullptr) {
return;
}

cout<<root->point.first<<" "<<root->point.second;
cout<<endl;

print_kd_tree(root->left);
print_kd_tree(root->right);

}

void helper(node * root , pair<double,double>p ,int level , double eps , vector<node *>&neigh ) {
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

vector<node * > searchQuery(node * root , pair<double, double>p, double eps) {
vector<node *>neigh;
helper(root , p , 1 , eps ,neigh);
return neigh;
}

vector<vector<pair<double ,double>>> getClusters(vector<pair<double ,double>>&v ,double eps , double minpts) {
vector<node *>allNodes;
node * root = build_kd_tree(v , allNodes);
queue<node *>q;
unordered_set<node *>visited;
vector<node *>neighbours;
vector<pair<double ,double>> cluster;
vector<vector<pair<double , double>>> clusters;

node * currNode;
for(auto &node : allNodes) {
if(visited.find(node) == visited.end() ) {
q.push(node);
visited.insert(node);
while(!q.empty()) {
currNode = q.front();
neighbours = searchQuery(root , currNode->point  , eps);
if(neighbours.size()>=minpts) {
for(auto & neigh : neighbours) {
if(visited.find(neigh) == visited.end() ) {
visited.insert(neigh);
q.push(neigh);
}
}
}
cluster.push_back(currNode->point);
q.pop();
} // while block
if(cluster.size()>=minpts) {
clusters.push_back(cluster);
}
cluster.clear();
}
}
delete root;
return clusters;
}

void printDensityClusters(vector<vector<pair<double,double>>>clusters) {
  for(auto &cluster : clusters) {
for( auto &point : cluster) {
cout<<"("<<point.first<<","<<point.second<<") ";
}
cout<<endl;
}
}
}
