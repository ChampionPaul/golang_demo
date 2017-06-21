package sorts

import "fmt"

/*
 * 冒泡排序原理:对给定的数组进行多次遍历，每次均比较相邻的两个数，如果前一个比后一个大，则交换这两个数。经过第
 * 一次遍历之后，最大的数就在最右侧了；第二次遍历之后，第二大的数就在右数第二个位置了；以此类推
 * 时间复杂度O(n2)
 */
func BubbleSort(arr []int) {
	for i := 0; i < len(arr); i++ {
		for j := 0; j < len(arr)-1-i; j++ {
			if arr[j] > arr[j+1] {
				arr[j], arr[j+1] = arr[j+1], arr[j]
			}
			fmt.Println(arr)
		}
	}
	fmt.Println(arr)
}

/*
 * 选择排序的原理:对给定的数组进行多次遍历，每次均找出最大的一个值的索引,
 * 时间复杂度O(n2)。
 */
func SecSort(arr []int) {
	for i := 0; i < len(arr); i++ {
		maxKey := 0
		for j := 1; j < len(arr)-i; j++ {
			if arr[j] > arr[maxKey] {
				maxKey = j
			}
		}
		if maxKey != i {
			arr[len(arr)-1-i], arr[maxKey] = arr[maxKey], arr[len(arr)-1-i]
		}
	}
	fmt.Println(arr)
}

/*
 * 插入排序的原理:从第二个数开始向右侧遍历，每次均把该位置的元素移动至左侧，放在放在一个正确的位置（比左侧大F，
 * 比右侧小）从第二个值开始拿出来，放到第一个比他小的数后面，比他大的数依次向后赋值，将拿出来的值放到合适index
 * 时间复杂度O(n2)
 */
func InsertSort(arr []int) {
	for i := 1; i < len(arr); i++ {
		if arr[i] < arr[i-1] {
			j := i - 1
			tmp := arr[i]
			for j >= 0 && arr[j] > tmp {
				arr[j+1] = arr[j]
				j--
			}
			arr[j+1] = tmp
		}
	}
	fmt.Println(arr)
}

/*
快速排序的原理:首先找到一个数pivot把数组'平均'分成两组，使其中一组的所有数字均大于另一组中的数字，此时pivot在数组中的位置就是它正确的位置。然后，对这两组数组再次进行这种操作。 时间复杂度，最坏的情况，目标序列完全倒序，快排退化成冒泡排序，时间复杂度为O(n2)，最优的情况下，时间复杂度为O(nlogn)
*/
func QuickSort(arr []int) {
	recursion(arr, 0, len(arr)-1)
	fmt.Println(arr)
}

/*
 *  递归函数:将目标数组不断递归分块
 */
func recursion(arr []int, left, right int) {
	if left < right {
		primVal := partition(arr, left, right)
		recursion(arr, left, primVal-1)
		recursion(arr, primVal+1, right)
	}
}

/*
 * 分块函数:将一个数组分成两部分，一部分的所有的值都比另一部分的值小
 */
func partition(arr []int, left, right int) int {
	for left < right {
		for left < right && arr[right] >= arr[left] {
			right--
		}
		if left < right {
			arr[left], arr[right] = arr[right], arr[left]
			left++
		}
		for left < right && arr[right] >= arr[left] {
			left++
		}
		if left < right {
			arr[left], arr[right] = arr[right], arr[left]
			right--
		}
	}
	return right
}
