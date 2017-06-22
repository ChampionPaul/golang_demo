package list

/*
 * 栈的实现:头结点即栈顶，入栈，出栈只在头部进行操作，所谓先进后出
 */

type NodeStack struct {
	data interface{}
	next *NodeStack
}

type Stack struct {
	len int
	top *NodeStack
}

func NewStack(num int) *Stack {
	stack := &Stack{}
	stack.len = 0
	stack.top = nil
	for i := 0; i < num; i++ {
		stack.Push(i)
	}
	return stack
}

//入栈
func (s *Stack) Push(data interface{}) {
	node := &NodeStack{}
	node.data = data
	node.next = s.top
	s.top = node
	s.len++
}

//出栈
func (s *Stack) Pop() interface{} {
	if s.len == 0 {
		return -1
	}
	data := s.top.data
	s.top = s.top.next
	s.len--
	return data
}
