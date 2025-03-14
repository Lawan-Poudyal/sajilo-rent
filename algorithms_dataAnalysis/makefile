CXX := g++
CXXFLAGS := -m64 -Wall -std=c++11

OBJS := densityClustering.o concentricClustering.o rangeQueryInKDTree.o main.o
SRCS := densityClustering.cpp concentricClustering.cpp rangeQueryInKDTree.cpp main.cpp
DEPS := densityClustering.h concentricClustering.h rangeQueryInKDTree.h
PREPROCESSED := densityClustering.i concentricClustering.i rangeQueryInKDTree.i main.i
ASSEMBLY := densityClustering.s concentricClustering.s rangeQueryInKDTree.s main.s

all: final

# Preprocess
%.i: %.cpp $(DEPS)
	$(CXX) $(CXXFLAGS) -E $< -o $@

# Compile to assembly
%.s: %.i 
	$(CXX) $(CXXFLAGS) -S $< -o $@

# Compile to object files
%.o: %.cpp $(DEPS)
	$(CXX) $(CXXFLAGS) -c $< -o $@

# Link
final: $(OBJS)
	$(CXX) $(CXXFLAGS) $^ -o $@ -lm -lstdc++

clean:
	rm -f $(OBJS) $(PREPROCESSED) $(ASSEMBLY) final