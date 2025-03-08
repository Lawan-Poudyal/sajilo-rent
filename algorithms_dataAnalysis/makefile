CXX := g++

OBJS := densityClustering.o concentricClustering.o rangeQueryInKDTree.o  main.o# object file created after compilation 

SRCS := densityClustering.cpp concentricClustering.cpp rangeQueryInKDTree.cpp main.cpp# source file written by programmer in high level language

DEPS := densityClustering.h concentricClustering.h rangeQueryInKDTree.h # dependencies , contains declerations of functions and classes

PREPROCESSED := densityClustering.i concentricClustering.i rangeQueryInKDTree.i main.i# preprocessed files

ASSEMBLY := densityClustering.s concentricClustering.s rangeQueryInKDTree.s main.s# assembly files

all : final # default target

%.i : %.cpp $(DEPS)
	$(CXX) -E $< -o $@

%.s : %.i 
	$(CXX) -S $< -o $@

%.o : %.S
	$(CXX) -c $< -o $@

final : $(OBJS)
	$(CXX) $^ -o $@

clear :  
	del $(OBJS) final.exe  
#or you can use  del *.o final.exe