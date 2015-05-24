'''
Generate google email aliases
Ex: given email is abc@gmail.com
=> Aliases: a.bc, ab.c, a.b.c can act as the same abc@gmail.com

Idea: supposed each 2 chars is separated by a binary number, 0 indicates no "dot" and 1 is "dot"
      regerate the list that has those properties, given the username
'''
import itertools

class GoogleAliases:
	def __init__(self, username):
		self.username = username
		self.aliases = []

	def generate_aliases(self):
		lst = map(list, itertools.product([0, 1], repeat=len(self.username)-1))
		lst.pop(0) # remove 000

		for item in lst:
			space = 0
			temp = self.username
			for i in range(0, len(item)):
				if item[i] == 1:
					temp = temp[:i+1+space] + "." + temp[i+1+space:]
					space = space + 1
			self.aliases.append(temp)

	def get_aliases(self):
		self.generate_aliases()
		return self.aliases

	def get_length(self):
		return len(self.aliases)